<!-- <template>
  <select v-model="currentLang" @change="changeLang(currentLang)">
    <option value="en">English</option>
    <option value="kh">Khmer</option>
  </select>
</template>

<script setup>
import { ref } from 'vue';
import { getItem } from '@/services/storage-service';

const t = window.t;
const changeLang = window.changeLang;

// ✅ load saved language
const currentLang = ref(getItem('lang') || 'en');
</script> -->


<template>
  <div class="lang-selector-container">
    <!-- Trigger Button -->
    <button
      class="lang-trigger"
      @click="open = !open"
      @blur="handleBlur"
      :class="{ open: open }"
    >
      <img :src="currentLangObj.icon" :alt="`${currentLangObj.label} flag`" class="flag-img" />
      <span class="lang-text">{{ currentLangObj.label }}</span>
      <svg class="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <polyline points="6 9 12 15 18 9"></polyline>
      </svg>
    </button>

    <!-- Dropdown Menu -->
    <transition name="dropdown-slide">
      <div v-if="open" class="lang-dropdown-menu" @mousedown.prevent>
        <div
          v-for="lang in langs"
          :key="lang.value"
          class="lang-item"
          :class="{ active: currentLang === lang.value }"
          @click="setLang(lang.value)"
        >
          <img :src="lang.icon" :alt="`${lang.label} flag`" class="flag-img-item" />
          <span class="lang-item-text">{{ lang.label }}</span>
          <svg v-if="currentLang === lang.value" class="checkmark" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { getItem } from '@/services/storage-service'

// PNG imports
import EnFlag from '@/assets/flags/enFlag.png'
import KhFlag from '@/assets/flags/khFlag.png'

const changeLang = window.changeLang

const langs = [
  { value: 'en', label: 'English', icon: EnFlag },
  { value: 'kh', label: 'Khmer', icon: KhFlag }
]

const currentLang = ref(getItem('lang') || 'en')
const open = ref(false)

const setLang = (lang) => {
  currentLang.value = lang
  changeLang(lang)
  open.value = false
}

const handleBlur = () => {
  setTimeout(() => {
    open.value = false
  }, 50)
}

const currentLangObj = computed(() =>
  langs.find((l) => l.value === currentLang.value)
)
</script>

<style scoped>
* {
  box-sizing: border-box;
}

.lang-selector-container {
  position: relative;
  display: inline-block;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* Trigger Button */
.lang-trigger {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.65rem 1.25rem;
  background-color: #ffffff;
  border: 1px solid #e0e0e0;
  border-radius: 0.75rem;
  cursor: pointer;
  font-size: 1rem;
  font-weight: 500;
  color: #333333;
  transition: all 0.2s ease;
  width: 160px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
  position: relative;
  z-index: 10;
}

.lang-trigger:hover:not(.open) {
  border-color: #d0d0d0;
  background-color: #fafafa;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
}

.lang-trigger:active {
  transform: scale(0.98);
}

.lang-trigger.open {
  border-color: #d0d0d0;
  background-color: #f5f5f5;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
  border-bottom: 1px solid #f5f5f5;
}

.lang-trigger:focus-visible {
  outline: 2px solid #2196f3;
  outline-offset: 0;
  border-radius: 0.75rem;
}

/* Flag Image */
.flag-img {
  width: 1.5rem;
  height: 1.5rem;
  border-radius: 0.35rem;
  object-fit: cover;
  flex-shrink: 0;
}

/* Language Text */
.lang-text {
  flex: 1;
  text-align: left;
  letter-spacing: -0.3px;
}

/* Chevron Icon */
.chevron {
  width: 1.2rem;
  height: 1.2rem;
  color: #999999;
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  flex-shrink: 0;
  stroke-width: 2;
}

.lang-trigger.open .chevron {
  transform: rotate(180deg);
}

/* Dropdown Menu */
.lang-dropdown-menu {
  position: absolute;
  top: calc(100% - 1px);
  left: 0;
  right: 0;
  background-color: #ffffff;
  border: 1px solid #e0e0e0;
  border-top: none;
  border-bottom-left-radius: 0.75rem;
  border-bottom-right-radius: 0.75rem;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  z-index: 20;
}

/* Dropdown Items */
.lang-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem 1.25rem;
  cursor: pointer;
  transition: background-color 0.15s ease;
  color: #666666;
  border-bottom: 1px solid #f5f5f5;
}

.lang-item:last-child {
  border-bottom: none;
}

.lang-item:hover:not(.active) {
  background-color: #fafafa;
  color: #333333;
}

.lang-item.active {
  background-color: #e3f2fd;
  color: #1976d2;
  font-weight: 500;
}

.lang-item.active:hover {
  background-color: #bbdefb;
}

/* Flag Image in Item */
.flag-img-item {
  width: 1.75rem;
  height: 1.75rem;
  border-radius: 0.4rem;
  object-fit: cover;
  flex-shrink: 0;
}

/* Item Text */
.lang-item-text {
  flex: 1;
  font-size: 1rem;
}

/* Checkmark */
.checkmark {
  width: 1.5rem;
  height: 1.5rem;
  color: #1976d2;
  flex-shrink: 0;
  stroke-width: 2.5;
}

/* Dropdown Animation */
.dropdown-slide-enter-active,
.dropdown-slide-leave-active {
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.dropdown-slide-enter-from {
  opacity: 0;
  transform: translateY(-6px);
}

.dropdown-slide-leave-to {
  opacity: 0;
  transform: translateY(-6px);
}

/* Responsive */
@media (max-width: 640px) {
  .lang-trigger {
    padding: 0.525rem 0.9rem;
    font-size: 0.95rem;
    width: 140px;
    gap: 0.625rem;
  }

  .flag-img {
    width: 1.375rem;
    height: 1.375rem;
  }

  .chevron {
    width: 1rem;
    height: 1rem;
  }

  .lang-item {
    padding: 0.875rem 1rem;
    gap: 0.875rem;
  }

  .flag-img-item {
    width: 1.5rem;
    height: 1.5rem;
  }

  .lang-item-text {
    font-size: 0.95rem;
  }

  .checkmark {
    width: 1.25rem;
    height: 1.25rem;
  }
}
</style>