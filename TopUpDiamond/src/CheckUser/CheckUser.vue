<!-- <template>
    <div>
        <Card>
        <template #title>{{t("Enter User ID")}}</template>
        <template #content>
            <div class="flex gap-3">
                <InputText type="text" fluid placeholder="Enter User ID" v-model="value" />
                <InputText type="text" fluid placeholder="Zone ID" v-model="value" />
            </div>
            <div>
                <Button label="Check ID" class="mt-3"></Button>
            </div>
             <p class="text-gray-400 text-sm mt-1">To find your User ID, click on your avatar in the top left corner of the main game screen. Then go to the "Basic Info" tab. Your user ID is shown below your nickname. Please input the complete user ID here, e.g. 12345678(1234).</p>
        </template>
    </Card>
    </div>
</template>
<script setup>
import { ref } from 'vue'
const t = window.t


const value = ref(null);

</script> -->

<template>
  <div>
    <Card>
      <template #title>
        {{ t('Enter User ID') }}
      </template>

      <template #content>
        <!-- Inputs -->
        <div class="flex gap-3">
          <InputText
            v-model="uid"
            placeholder="Enter User ID"
            class="w-full"
          />
          <InputText
            v-model="zone"
            placeholder="Zone ID"
            class="w-full"
          />
        </div>

        <!-- Button -->
        <Button
          label="Check ID"
          class="mt-3"
          :loading="loading"
          @click="checkUser"
        />

        <!-- Success -->
        <div v-if="result" class="mt-3 text-green-600">
          ✅ Nickname:
          <strong>{{ result.name }}</strong>
        </div>

        <!-- Error -->
        <div v-if="error" class="mt-3 text-red-500">
          ❌ {{ error }}
        </div>

        <!-- Info -->
        <p class="text-gray-400 text-sm mt-2">
          To find your User ID, click your avatar in the game → Basic Info.
          Example: <b>12345678(1234)</b>
        </p>
      </template>
    </Card>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const t = window.t || ((v) => v)

// form values
const uid = ref('')
const zone = ref('')

// state
const loading = ref(false)
const result = ref(null)
const error = ref('')

// action
const checkUser = async () => {
  if (!uid.value || !zone.value) {
    error.value = 'Please enter User ID and Zone ID'
    return
  }

  loading.value = true
  error.value = ''
  result.value = null

  try {
    const res = await axios.post(
      'http://127.0.0.1:8000/api/games/check-user',
      {
        mobile_legends: {
          uid: uid.value,
          zone: zone.value
        }
      }
    )

    if (res.data?.mobile_legends?.success) {
      result.value = res.data.mobile_legends
    } else {
      error.value = 'User not found'
    }
  } catch (e) {
    error.value = 'Server error, please try again'
  } finally {
    loading.value = false
  }
}
</script>
