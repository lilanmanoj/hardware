<template>
    <div class="bg-theme-light relative overflow-hidden m-0 p-0 w-full">
        <div id="header" class="overflow-hidden w-full relative">
            <div class="my-4 mx-auto w-4/5 h-full relative">
                <nav class="inline-flex text-theme-light font-bold text-xl">
                    <img alt="Logo" src="../../assets/images/logo.png" class="logo">

                    <li><a href="#about">About Us</a></li>
                    <li><a href="#">Explore</a></li>
                    <li><a href="#">Contact Us</a></li>

                    <li>
                        <input type="text" placeholder="Search" class="search bg-transparent flex-grow border-gray-300 rounded-full pl-6">
                    </li>

                    <div class="absolute right-0 mt-5 text-lg" v-if="$page.props.user">
                        <inertia-link href="/dashboard" class="bg-transparent border border-theme-yellow rounded-lg font-bold text-theme-yellow py-2 px-4">
                            Dashboard
                        </inertia-link>
                    </div>

                    <template v-else>
                        <div class="absolute right-0 mt-5 text-lg">
                            <inertia-link v-if="canRegister" :href="route('register')" class="bg-transparent border border-theme-yellow rounded-lg font-bold text-theme-yellow py-2 px-4">
                                Sign Up
                            </inertia-link>

                            <inertia-link :href="route('login')" class="bg-theme-dark border border-theme-yellow rounded-lg font-bold text-theme-yellow max-h-10 py-2 px-5 ml-5">
                                Sign In
                            </inertia-link>
                        </div>
                    </template>
                </nav>
                
                <div class="transform translate-y-1/2">
                    <h1 class="text-7xl text-theme-light font-extrabold w-1/2">Lorem ipsum dolor</h1>
                    <h1 class="text-6xl text-theme-yellow font-extrabold w-2/5">sit amet, eos laudem</h1>
                    <p class="text-base text-theme-light font-bold text-opacity-80 w-1/2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed bibendum diam in leo lacinia gravida. 
                    Etiam luctus velit non odio egestas, eu luctus massa tempus.</p>

                    <form class="bg-theme-light w-1/2 mt-12 p-6 rounded-lg">
                        <h4 class="text-normal font-bold">Join  Now Today!</h4>

                        <div class="flex gap-x-4 mt-3">
                            <input type="text" placeholder="Enter your email address here" class="flex-grow border-gray-300 rounded-full pl-6">
                            <button type="submit" class="bg-theme-yellow px-5 rounded-lg font-bold">Join Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="about" class="overflow-hidden w-full relative">
            <div class="my-4 mx-auto w-4/5 h-full relative">

            </div>
        </div>
    </div>
</template>

<style scoped>
    #header {
        background-image: linear-gradient(to bottom, #000000c2, #0000005f), url('../../assets/images/header.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        height: 90vh;
    }

    #header nav {
        list-style: none;
    }

    #header nav li {
        margin: 14px 10px 0 24px;
    }

    #header nav .search {
        width: 300px;
    }

    #header nav .logo {
        width: 120px;
        margin-right: 20px;
    }

    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }
    }
</style>

<script>
    export default {
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            appName: String,
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            }
        }
    }
</script>