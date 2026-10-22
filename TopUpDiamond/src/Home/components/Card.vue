<template>
  <div class="grid">
    <div
      class="col-4 md:col-6 lg:col-2 m-0"
      v-for="game in games"
      :key="game.id"
    >
      <RouterLink :to="`/game/${game.id}`" class="block h-full">
        <Card class="game-card m-0 p-0 overflow-hidden h-full">
          <template #header>
            <div class="game-card-media w-full overflow-hidden relative">
              <img
                :src="game.image"
                class="object-cover w-full h-full"
                alt="game image"
              />
              <!-- Optional badges -->
              <span
                v-if="game.is_new"
                class="game-badge game-badge-new"
              >
                NEW
              </span>
              <span
                v-if="game.is_popular"
                class="game-badge game-badge-popular"
              >
                POPULAR
              </span>
            </div>
          </template>
          <template #content>
            <p class="game-card-title m-0">{{ game.name }}</p>
          </template>
        </Card>
      </RouterLink>
    </div>
  </div>
</template>

<script setup>
  defineProps({
    games: {
      type: Array,
      required: true
    }
  })
</script>

<style scoped>
  .game-card-media {
    height: 12rem;
  }

  .game-card-title {
    padding: 0.5rem;
    text-align: center;
    font-weight: 700;
  }

  .game-badge {
    position: absolute;
    top: 0.5rem;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: 600;
    line-height: 1;
  }

  .game-badge-new {
    left: 0.5rem;
    background: #22c55e;
    color: #ffffff;
  }

  .game-badge-popular {
    right: 0.5rem;
    background: #facc15;
    color: #000000;
  }

  /* Mobile: 3 cards per row */
  @media (max-width: 767px) {
    .game-card :deep(.p-card-body) {
      padding: 0;
      margin: 0;
    }

    .game-card-media {
      height: auto;
      aspect-ratio: 1 / 1;
    }

    .game-badge {
      top: 0.2rem;
      padding: 0.1rem 0.25rem;
      font-size: 0.5rem;
    }

    .game-badge-new {
      left: 0.2rem;
    }

    .game-badge-popular {
      right: 0.2rem;
    }

    .game-card-title {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      box-sizing: border-box;
      min-height: calc(2.4em + 0.7rem);
      padding: 0.35rem 0.15rem;
      font-size: 0.7rem;
      line-height: 1.2;
      font-weight: 600;
      overflow-wrap: anywhere;
    }
  }
</style>
