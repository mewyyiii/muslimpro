/**
 * public/azan-sw.js — Service Worker Notifikasi Azan
 */

let azanSettings = null;
let prayerTimes  = null;
let firedToday   = {};

const AUDIO_URLS = {
    makkah  : 'https://www.islamcan.com/audio/adhan/azan1.mp3',
    madinah : 'https://www.islamcan.com/audio/adhan/azan2.mp3',
    mesir   : 'https://www.islamcan.com/audio/adhan/azan3.mp3',
};

const PRAYER_LABELS = {
    fajr    : 'Subuh',
    dhuhr   : 'Dzuhur',
    asr     : 'Ashar',
    maghrib : 'Maghrib',
    isha    : 'Isya',
};

const PRAYER_EMOJIS = {
    fajr    : '🌅',
    dhuhr   : '☀️',
    asr     : '🌤️',
    maghrib : '🌇',
    isha    : '🌙',
};

self.addEventListener('install',  () => self.skipWaiting());
self.addEventListener('activate', (e) => {
    e.waitUntil(self.clients.claim());
    startChecking();
});

self.addEventListener('message', (event) => {
    const { type, settings, times } = event.data || {};
    if (type === 'UPDATE_AZAN_SETTINGS') {
        azanSettings = settings;
    }
    if (type === 'UPDATE_PRAYER_TIMES') {
        prayerTimes = times;
        firedToday  = {};
    }
    if (type === 'UPDATE_ALL') {
        azanSettings = settings;
        prayerTimes  = times;
        firedToday   = {};
    }
});

function startChecking() {
    setInterval(() => {
        if (!azanSettings || !prayerTimes) return;
        if (!azanSettings.azan_enabled) return;
        checkAzan();
    }, 30000);
}

function checkAzan() {
    const now      = new Date();
    const todayStr = now.toISOString().split('T')[0];
    const hh       = String(now.getHours()).padStart(2, '0');
    const mm       = String(now.getMinutes()).padStart(2, '0');
    const current  = `${hh}:${mm}`;

    for (const prayer of ['fajr', 'dhuhr', 'asr', 'maghrib', 'isha']) {
        const time      = prayerTimes[prayer];
        const enabled   = azanSettings[`${prayer}_enabled`];
        const fired     = firedToday[prayer] === todayStr;

        if (!time || !enabled || fired) continue;

        if (isWithinMinute(current, time)) {
            firedToday[prayer] = todayStr;
            triggerAzan(prayer, time);
        }
    }
}

function isWithinMinute(current, target) {
    const [ch, cm] = current.split(':').map(Number);
    const [th, tm] = target.split(':').map(Number);
    const diff     = (ch * 60 + cm) - (th * 60 + tm);
    return diff >= 0 && diff <= 1;
}

async function triggerAzan(prayer, time) {
    const label   = PRAYER_LABELS[prayer];
    const emoji   = PRAYER_EMOJIS[prayer];
    const muadzin = azanSettings.muadzin || 'makkah';

    // Notifikasi browser
    await self.registration.showNotification(`${emoji} Waktu ${label}`, {
        body    : `Telah masuk waktu shalat ${label} — ${time}`,
        icon    : '/favicon.ico',
        badge   : '/favicon.ico',
        tag     : `azan-${prayer}`,
        vibrate : [200, 100, 200],
        data    : { prayer, time, url: '/prayer-tracking' },
        actions : [
            { action: 'open',    title: '📋 Catat Shalat' },
            { action: 'dismiss', title: 'Tutup' },
        ],
    }).catch(() => {});

    // Kirim ke tab yang terbuka → play audio
    const clients = await self.clients.matchAll({ type: 'window' });
    for (const client of clients) {
        client.postMessage({
            type     : 'PLAY_AZAN',
            prayer,
            audioUrl : AUDIO_URLS[muadzin],
            label,
            emoji,
        });
    }
}

self.addEventListener('notificationclick', (event) => {
    event.notification.close();
    if (event.action === 'dismiss') return;
    event.waitUntil(
        self.clients.matchAll({ type: 'window' }).then((list) => {
            const url = event.notification.data?.url || '/prayer-tracking';
            for (const client of list) {
                if (client.url.includes('prayer-tracking') && 'focus' in client) return client.focus();
            }
            return self.clients.openWindow(url);
        })
    );
});