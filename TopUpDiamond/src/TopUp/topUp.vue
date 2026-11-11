<template>
  <section class="recharge mt-3" aria-labelledby="recharge-title">
    <div class="heading">
      <div><span class="eyebrow">TOP UP YOUR GAME</span><h2 id="recharge-title">Choose your recharge</h2><p>Pick a package and get back to playing.</p></div>
      <span class="heading-icon" aria-hidden="true"><i class="pi pi-bolt"></i></span>
    </div>

    <section v-if="BestSellers.length" class="package-section" aria-labelledby="featured-title">
      <div class="section-heading"><div><span class="section-kicker">PLAYER FAVORITES</span><h3 id="featured-title">Best sellers</h3><p>Our most popular picks, all in one place.</p></div><span class="featured-pill"><i class="pi pi-star-fill" aria-hidden="true"></i> Popular</span></div>
      <div class="package-grid">
        <button v-for="pkg in BestSellers" :key="pkg.id" type="button" class="package-card" :class="{ selected: selectedPackageId === pkg.id }" :aria-pressed="selectedPackageId === pkg.id" @click="selectPackage(pkg)">
          <span class="selection-mark" aria-hidden="true"><i class="pi pi-check"></i></span>
          <span class="package-image"><img v-if="pkg.image" :src="pkg.image" alt="" loading="lazy" /><i v-else class="pi pi-bolt" aria-hidden="true"></i></span>
          <span class="package-name">{{ pkg.name || 'Recharge package' }}</span>
          <span class="package-amount">{{ pkg.amount }} {{ pkg.unit_name || pkg.Unit || '' }}</span>
          <span class="package-price"><strong>{{ pkg.currency_symbol || '' }}{{ pkg.price ?? '—' }}</strong><span v-if="pkg.discount" class="discount">{{ pkg.discount }}</span></span>
          <span v-if="pkg.discount && pkg.fullprice != null" class="old-price">{{ pkg.currency_symbol || '' }}{{ pkg.fullprice }}</span>
        </button>
      </div>
    </section>

    <section class="package-section" aria-labelledby="browse-title">
      <div class="section-heading"><div><span class="section-kicker">FIND YOUR FAVORITE</span><h3 id="browse-title">Browse all items</h3><p>Explore the available recharge options.</p></div></div>
      <div class="package-grid">
        <button v-for="pkg in gamePackages" :key="pkg.id" type="button" class="package-card" :class="{ selected: selectedPackageId === pkg.id }" :aria-pressed="selectedPackageId === pkg.id" @click="selectPackage(pkg)">
          <span class="selection-mark" aria-hidden="true"><i class="pi pi-check"></i></span>
          <span class="package-image"><img v-if="pkg.image" :src="pkg.image" alt="" loading="lazy" /><i v-else class="pi pi-bolt" aria-hidden="true"></i></span>
          <span class="package-name">{{ pkg.name || 'Recharge package' }}</span>
          <span class="package-amount">{{ pkg.amount }} {{ pkg.unit_name || pkg.Unit || '' }}</span>
          <span class="package-price"><strong>{{ pkg.currency_symbol || '' }}{{ pkg.price ?? '—' }}</strong><span v-if="pkg.discount" class="discount">{{ pkg.discount }}</span></span>
          <span v-if="pkg.discount && pkg.fullprice != null" class="old-price">{{ pkg.currency_symbol || '' }}{{ pkg.fullprice }}</span>
        </button>
      </div>
    </section>
  </section>
</template>

<script setup>
import {ref, onMounted,watch } from 'vue'
import { useRoute } from 'vue-router';

const route = useRoute();
const gameId = ref(route.params.id); 
const gamePackages = ref([]);
const BestSellers = ref([]);
const gameName = ref('');
const emit = defineEmits(['package-selected'])
const selectedPackageId = ref(null)
const selectPackage = (pkg) => {
  selectedPackageId.value = pkg.id
   emit('package-selected', pkg) 
}

async function getPackagesByGame(id) {
  try {
    const res = await app.getApi('topupPackage');
    if (res.data) {
      
      const packages = res.data.filter(pkg => pkg.game_id == id);
      BestSellers.value = packages.filter(pkg => pkg.best_seller == 1);
      gamePackages.value = packages.filter(pkg => pkg.best_seller == 0);

      if (packages.length > 0) {
        gameName.value = packages[0].name.includes("ML") ? "Mobile Legends" : `Game ${id}`;
      } else {
        gameName.value = `Game ${id}`;
      }
    }
  } catch (error) {
    console.error("Error fetching packages:", error);
  }
}

onMounted(() => getPackagesByGame(gameId.value));

watch(() => route.params.id, (newId) => {
  gameId.value = newId;
  selectedPackageId.value = null;
  getPackagesByGame(newId);
});

</script>

<style scoped>
.recharge { padding: 1.5rem; border: 1px solid var(--p-content-border-color, #e5e7eb); border-radius: 1.1rem; background: var(--p-content-background, #fff); color: var(--p-content-color, #18231d); }
.heading, .section-heading { display: flex; justify-content: space-between; align-items: center; gap: 1rem; }
.eyebrow, .section-kicker { color: #15803d; font-size: 0.64rem; font-weight: 800; letter-spacing: 0.12em; }
.heading h2 { margin: 0.4rem 0 0.3rem; font-size: 1.4rem; line-height: 1.2; }
.heading p, .section-heading p { margin: 0; opacity: 0.65; font-size: 0.84rem; line-height: 1.5; }
.heading-icon { display: grid; place-items: center; width: 3rem; height: 3rem; border-radius: 0.9rem; background: #dcfce7; color: #15803d; flex-shrink: 0; }
.package-section { margin-top: 2rem; }
.section-heading { margin-bottom: 1rem; }
.section-heading h3 { margin: 0.3rem 0 0.2rem; font-size: 1.05rem; }
.featured-pill { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.4rem 0.6rem; border-radius: 99px; background: #dcfce7; color: #15803d; font-size: 0.7rem; font-weight: 700; white-space: nowrap; }
.featured-pill i { font-size: 0.65rem; }
.package-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 0.75rem; }
.package-card { position: relative; display: flex; flex-direction: column; align-items: flex-start; min-width: 0; padding: 0.85rem; border: 1px solid var(--p-content-border-color, #e5e7eb); border-radius: 0.85rem; background: var(--p-content-background, #fff); color: inherit; font: inherit; text-align: left; cursor: pointer; transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s; }
.package-card:hover { border-color: #22c55e; transform: translateY(-2px); }
.package-card:focus-visible { outline: 3px solid #86efac; outline-offset: 2px; }
.package-card.selected { border-color: #16a34a; box-shadow: 0 0 0 1px #16a34a; }
.selection-mark { position: absolute; top: 0.7rem; right: 0.7rem; display: grid; place-items: center; width: 1.25rem; height: 1.25rem; border: 1px solid var(--p-content-border-color, #d1d5db); border-radius: 50%; color: transparent; }
.selected .selection-mark { border-color: #16a34a; background: #16a34a; color: white; }
.selection-mark i { font-size: 0.6rem; }
.package-image { display: grid; place-items: center; width: 3.5rem; height: 3.5rem; margin-bottom: 0.9rem; border-radius: 0.75rem; background: var(--p-surface-100, #f4f7f4); color: #16a34a; }
.package-image img { width: 100%; height: 100%; border-radius: inherit; object-fit: cover; }
.package-name { font-size: 0.85rem; font-weight: 700; overflow-wrap: anywhere; }
.package-amount { margin-top: 0.2rem; opacity: 0.65; font-size: 0.75rem; }
.package-price { display: flex; flex-wrap: wrap; align-items: center; gap: 0.4rem; margin-top: 0.9rem; }
.package-price strong { font-size: 0.95rem; }
.discount { padding: 0.2rem 0.35rem; border-radius: 0.3rem; background: #dcfce7; color: #15803d; font-size: 0.65rem; font-weight: 700; }
.old-price { margin-top: 0.2rem; opacity: 0.55; font-size: 0.72rem; text-decoration: line-through; }
.category-list { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0.75rem; }
.category { display: flex; align-items: center; gap: 0.8rem; padding: 0.85rem; border: 1px solid var(--p-content-border-color, #e5e7eb); border-radius: 0.85rem; }
.category-image { display: grid; place-items: center; width: 2.9rem; height: 2.9rem; flex-shrink: 0; border-radius: 0.65rem; background: var(--p-surface-100, #f4f7f4); }
.category-image img { width: 2rem; height: 2rem; object-fit: contain; }
.category strong, .category small { display: block; }
.category strong { font-size: 0.8rem; }
.category small { margin-top: 0.2rem; opacity: 0.6; font-size: 0.7rem; }
.grid-title { margin: 1.4rem 0 0.8rem; font-size: 0.9rem; }
@media (max-width: 600px) { .recharge { padding: 1.1rem; } .package-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0.6rem; } .category-list { grid-template-columns: 1fr; } .package-card { padding: 0.75rem; } }
@media (prefers-reduced-motion: reduce) { .package-card { transition: none; } }
</style>
