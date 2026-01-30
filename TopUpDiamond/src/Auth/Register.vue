<template>
  <div class="flex justify-content-center align-items-center min-h-screen surface-ground px-3">
    <div class="surface-card border-round-2xl shadow-4 p-6 w-full md:w-30rem">

      <form @submit.prevent="AddUser" class="flex flex-column gap-4">

        <!-- Title -->
        <div class="text-center mb-3">
          <h2 class="text-900 text-3xl font-semibold">Register</h2>
          <span class="text-600 text-sm">Create your account</span>
        </div>

        <!-- Username -->
        <div class="flex flex-column gap-2">
          <label class="text-700 font-medium">Username</label>
          <input
            v-model="user.name"
            type="text"
            class="bordered-input"
            placeholder="Enter username"
            required
          />
        </div>

        <!-- Email -->
        <div class="flex flex-column gap-2">
          <label class="text-700 font-medium">Email</label>
          <input
            v-model="user.email"
            type="email"
            class="bordered-input"
            placeholder="Enter email"
            required
          />
        </div>

        <!-- Password -->
        <div class="flex flex-column gap-2">
          <label class="text-700 font-medium">Password</label>
          <input
            v-model="user.password"
            type="password"
            class="bordered-input"
            placeholder="Enter password"
            required
          />
        </div>

        <!-- Button -->
        <button type="submit" class="primary-btn">
          Register
        </button>

        <!-- Divider -->
        <div class="flex align-items-center my-3">
          <div class="flex-1 border-top-1 surface-border"></div>
          <span class="px-3 text-500 text-sm">OR</span>
          <div class="flex-1 border-top-1 surface-border"></div>
        </div>

        <!-- Social -->
        <button type="button" class="social-btn telegram">
          <i class="pi pi-telegram"></i>
          Login with Telegram
        </button>

        <button type="button" class="social-btn google">
          <i class="pi pi-google"></i>
          Login with Google
        </button>

        <!-- Login -->
        <div class="text-center text-sm text-600 mt-3">
          Already have an account?
          <a href="/login" class="text-primary font-semibold ml-1">Login</a>
        </div>

      </form>
    </div>
  </div>
</template>


<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()

const user = ref({
  name: '',
  email: '',
  password: ''
})

async function AddUser() {
  try {
    await axios.post('http://localhost:8000/api/register', {
      name: user.value.name,
      email: user.value.email,
      password: user.value.password
    })

    // Clear form
    user.value.name = ''
    user.value.email = ''
    user.value.password = ''

    router.push('/login')
  } catch (error) {
    console.error('Registration error:', error)
  }
}
</script>

<style scoped>
/* Smooth transitions for all interactive elements */
button, input, a {
  transition: all 0.3s ease;
}

/* Remove spinner from number inputs if needed */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.bordered-input {
  padding: 0.75rem 1rem;
  border-radius: 0.75rem;
  border: 1.5px solid #d1d5db; /* visible border */
  font-size: 0.95rem;
  background: #fff;
  transition: all 0.25s ease;
}

.bordered-input:focus {
  outline: none;
  border-color: #22c55e; /* green */
  box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
}

.primary-btn {
  padding: 0.8rem;
  border-radius: 0.75rem;
  background: #22c55e;
  color: #fff;
  font-weight: 600;
  border: none;
  cursor: pointer;
  transition: all 0.25s ease;
}

.primary-btn:hover {
  background: #16a34a;
  transform: translateY(-1px);
}

.social-btn {
  padding: 0.75rem;
  border-radius: 0.75rem;
  border: 1.5px solid #d1d5db;
  background: #fff;
  font-weight: 500;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.6rem;
  transition: all 0.25s ease;
}

.social-btn:hover {
  background: #f9fafb;
}

.telegram { color: #229ED9; }
.google { color: #DB4437; }

</style>