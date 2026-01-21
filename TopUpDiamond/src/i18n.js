import { createI18n } from 'vue-i18n';
import { getItem, setItem } from '@/services/storage-service';
import en from '@/locales/en.json';
import kh from '@/locales/kh.json';

const messages = {
  en,
  kh
};

const i18n = createI18n({
  legacy: false,
  locale: getItem('lang') || 'en',
  fallbackLocale: 'en',
  messages,
});

// 🌍 global t()
window.t = (key) => i18n.global.t(key);

// 🌍 change language + save to localStorage
window.changeLang = (lang) => {
  i18n.global.locale.value = lang;
  setItem('lang', lang); // ✅ saved correctly
};

export default i18n;