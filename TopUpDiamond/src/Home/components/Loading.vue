<template>
  <div class="loading" role="status" aria-live="polite">
    <span class="spinner" aria-hidden="true"></span>
    <span>Loading...</span>
  </div>
</template>

<style scoped>
.loading {
  min-height: 100vh;
  min-height: 100dvh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 1rem;
  color: inherit;
}

.spinner {
  width: 2.75rem;
  height: 2.75rem;
  border: 4px solid rgba(128, 128, 128, 0.25);
  border-top-color: #22c55e;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

@media (prefers-reduced-motion: reduce) {
  .spinner { animation-duration: 2s; }
}
</style>
