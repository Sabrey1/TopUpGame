<template>
  <div class="flex justify-content-center align-items-center min-h-screen surface-ground px-3">
    <div class="surface-card shadow-4 border-round-2xl p-5 w-full sm:w-25rem">

      <form @submit.prevent="onLogin" class="flex flex-column gap-4">

        <!-- Title -->
        <div class="text-center mb-2">
          <h2 class="text-900 text-2xl font-semibold m-0">Login</h2>
          <span class="text-600 text-sm">Welcome back</span>
        </div>

        <!-- Email -->
        <div class="flex flex-column gap-2">
          <label class="text-700 font-medium">Email</label>
          <input
            type="email"
            v-model="user.email"
            class="bordered-input"
            placeholder="Enter email"
            required
          />
        </div>

        <!-- Password -->
        <div class="flex flex-column gap-2">
          <label class="text-700 font-medium">Password</label>
          <input
            type="password"
            v-model="user.password"
            class="bordered-input"
            placeholder="Enter password"
            required
          />
        </div>

        <!-- Login Button -->
        <button type="submit" class="primary-btn bg-blue-500">
          Login
        </button>

        <!-- Forgot -->
        <div class="text-right">
          <a href="#" class="text-sm text-primary">Forgot password?</a>
        </div>

        <!-- Divider -->
        <div class="flex align-items-center my-2">
          <div class="flex-1 border-top-1 surface-border"></div>
          <span class="px-2 text-500 text-sm">OR</span>
          <div class="flex-1 border-top-1 surface-border"></div>
        </div>

        <!-- Social Buttons -->
        <button type="button" class="social-btn telegram">
          <i class="pi pi-telegram"></i>
          Login with Telegram
        </button>

        <button type="button" class="social-btn google">
          <i class="pi pi-google"></i>
          Login with Google
        </button>

        <!-- Register -->
        <div class="text-center text-sm text-600 mt-2">
          Don’t have an account?
          <a href="/register" class="text-primary font-semibold ml-1">
            Register
          </a>
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
  email: '',
  password: ''
})

async function onLogin() {
  try {
    const response = await axios.post('http://localhost:8000/api/login', {
      email: user.value.email,
      password: user.value.password
    })

     
    // Clear form
    user.value.email = ''
    user.value.password = ''

    router.push('/admin')

  } catch (error) {
    if (error.response && error.response.data.message) {
    //   alert(error.response.data.message)
    }
  }
}
</script>

<style scoped>
.bordered-input {
  width: 100%;
  padding: 0.75rem 1rem;
  border-radius: 0.75rem;
  border: 1.5px solid #d1d5db;
  font-size: 0.95rem;
  transition: all 0.25s ease;
}

.bordered-input:focus {
  outline: none;
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.25);
}

.primary-btn {
  width: 100%;
  padding: 0.75rem;
  border-radius: 0.75rem;
   
  color: white;
  font-weight: 600;
  border: none;
  cursor: pointer;
  transition: all 0.25s ease;
}

.primary-btn:hover {
  filter: brightness(0.95);
  transform: translateY(-1px);
}

.social-btn {
  width: 100%;
  padding: 0.7rem;
  border-radius: 0.75rem;
  border: 1.5px solid #d1d5db;
  background: #fff;
  font-weight: 500;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  cursor: pointer;
  transition: all 0.25s ease;
}

.social-btn:hover {
  background: #f9fafb;
}

.telegram { color: #229ED9; }
.google { color: #DB4437; }

</style>