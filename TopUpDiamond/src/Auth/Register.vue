<template>
    <div class="flex flex-1 min-h-screen border-round shadow-2 p-2 align-content-center align-items-center justify-content-center  ">
        <div class=" bg-gray-200 p-3 w-20rem h-40rem border-round">
            <form>
                <h1 class="mt-0 text-center">Register</h1>
                
                <p class="m-0">Username</p>
                <input type="text" class="w-full h-2rem border-round border-none p-2" placeholder="Enter Username">
                <p class="m-0">Gmail</p>
                <input type="text" class="w-full h-2rem border-round border-none p-2" placeholder="Enter Gmail">
                <p class="m-0">Password</p>
                <input type="password" class="w-full h-2rem border-round border-none p-2" placeholder="Enter Password">
                <br>
                <br>
                <button type="submit" class="w-full h-2rem bg-green-500 text-white  border-round border-none text-lg">Login</button>
                <a href="#" class="text-sm">Forgot Password</a>
                <hr>
                <button class="w-full border-round h-2rem bg-blue-400 border-none flex align-items-center justify-content-center">
                    <i class="pi pi-telegram mr-3" ></i>
                    <p>Login With Telegram</p>                  
                </button>
                <button class="w-full mt-2 border-round h-2rem bg-cyan-400 border-none flex align-items-center justify-content-center">
                    <i class="pi pi-google mr-3" ></i>
                    <p>Login With Google</p>                  
                </button>
                <a href="/login" class="text-sm justify-content-end flex mt-2">I have an account Already.</a>
            </form>
        </div>
    </div>
</template>

<script setup>

</script>