<template>
    <div class="bg-theme-light relative overflow-hidden m-0 p-0 w-full">
        <header class="overflow-hidden w-full relative">
            <div class="container mx-auto my-4 h-full overflow-hidden relative">
                <nav class="inline-flex text-theme-light font-bold text-xl">
                    <img alt="Logo" src="../../assets/images/logo-only-logo.png" class="logo">

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
                            <inertia-link v-if="canRegister" :href="route('register')" class="bg-transparent border border-theme-yellow rounded-lg font-bold text-theme-yellow ml-5 py-1 px-6">
                                Sign Up
                            </inertia-link>

                            <inertia-link :href="route('login')" class="bg-theme-dark border border-white rounded-lg font-bold text-theme-yellow max-h-10 ml-5 py-1 px-7">
                                Sign In
                            </inertia-link>
                        </div>
                    </template>
                </nav>
                
                <div class="overflow-hidden transform translate-y-1/2">
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
        </header>

        <div id="about" class="container mx-auto my-14 relative">
            <div class="wrapper h-auto w-full flex gap-6">
                <div class="content w-1/2 py-12 pr-6">
                    <h1 class="text-theme-yellow text-lg font-semibold mb-2">About Us</h1>
                    <h2 class="text-black text-3xl font-extrabold mb-8 max-w-xs">Well, who we are actually?</h2>

                    <p class="text-gray-400 mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla faucibus fermentum eros sed tincidunt. Donec porta dictum magna, eget eleifend neque mollis mollis. Sed pretium interdum nisi nec dapibus. Phasellus finibus semper porta. Aliquam et dignissim velit, a posuere nisl. Suspendisse scelerisque nulla nec dolor ultrices gravida.
                    </p>

                    <p class="text-gray-400 mb-4">
                        Quisque aliquet faucibus felis lacinia sagittis. Aliquam consectetur est libero, et tristique urna auctor sed. Suspendisse potenti. Cras ac condimentum ipsum. Vestibulum auctor, ipsum et porta convallis, turpis lectus tempor velit, non tempor purus odio eget quam. Curabitur sed tristique ex. Cras eu augue ac erat sollicitudin posuere ut at mauris. Etiam rhoncus mi in risus mollis, sit amet mollis tortor faucibus.
                    </p>
                </div>
                
                <div class="featured-image flex-grow bg-center bg-no-repeat bg-cover relative">
                    <div class="feedback-container bg-black absolute w-1/2 p-6 rounded-md border-2 border-yellow-400">
                        <blockquote class="text-sm text-gray-100 italic">
                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla faucibus fermentum eros sed tincidunt. Donec porta dictum magna, eget eleifend neque mollis mollis."
                        </blockquote>

                        <div class="feedback-client mt-4 flex">
                            <img class="rounded-full h-12 w-12 mr-4" src="../../assets/images/feedback_user.jpg">

                            <div class="flex-grow pb-2">
                                <h5 class="text-white text-base font-bold">John Doe</h5>
                                <h6 class="text-yellow-400 text-sm">Founder & Ceo, Hardware Store Name</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="explore" class="w-full my-14 relative">
            <div class="wrapper container mx-auto h-auto w-full flex gap-6">
                <div class="content w-1/2 py-12 pr-6">
                    <h1 class="text-theme-yellow text-lg font-semibold mb-2">Explore</h1>
                    <h2 class="text-black text-3xl font-extrabold mb-8 max-w-xs">Check out the following categories</h2>
                </div>
            </div>

            <div class="w-full py-4 px-0 bg-black h-auto overflow-hidden">
                <h2 class="container mx-auto text-white text-3xl font-black mb-2">Categories</h2>


            </div>
        </div>
    </div>
</template>

<style scoped>
    header {
        background-image: linear-gradient(to bottom, #000000c2, #0000005f), url('../../assets/images/header.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        height: 90vh;
    }

    header nav {
        list-style: none;
    }

    header nav li {
        margin: 14px 10px 0 24px;
    }

    header nav .search {
        width: 300px;
    }

    header nav .logo {
        width: 120px;
        margin-right: 20px;
    }

    #about .wrapper .featured-image {
        background-image: url('../../assets/images/about.jpg');
        min-height: 50vh;
        height: auto;
    }

    #about .wrapper .featured-image .feedback-container {
        left: -30px;
        bottom: -20px;
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