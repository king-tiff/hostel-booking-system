<script setup>
    import { Link } from '@inertiajs/vue3';
    import NavLink from '@/Components/NavLink.vue';
    import LinkButton from '@/Components/LinkButton.vue';
    
    defineProps({
        isPadded: {
            type: Boolean,
            default: true,
        },
    });

</script>

<template>
    <div>
        <header>
            <nav class="navbar py-4 px-2 flex items-center justify-between lg:px-28">
                <div class="text-2xl font-bold">
                    <Link :href="'/'">Hostel Hub</Link>
                </div>
                <div class="flex items-center gap-x-6">
                    <ul class="hidden md:flex">
                        <!-- <NavLink :href="route('jobs')" class="px-2">Jobs</NavLink> -->
                        <!-- <NavLink class="px-2">How it works?</NavLink>
                        <NavLink class="px-2">About</NavLink> -->
                    </ul>

                    <LinkButton title="Login" :href="route('login')" type="secondary" />
                    <LinkButton title="Book Hostel" :href="route('register')"/>
                    <!-- <LinkButton title="Find my next job" :href="route('jobs')" /> -->
                </div>
            </nav>
        </header>
        <main class="mt-20 px-2 h-full" :class="{ 'lg:px-28': isPadded, 'lg:px-0': !isPadded }">
            <slot />
        </main>
        <footer class="mt-auto px-2 py-4 lg:px-28">
            <hr />
            <div class="flex justify-between items-center py-4">
                <div>
                    <div class="text-lg lg:text-2xl font-bold">Hostel Hub</div>
                </div>
                <div>
                    <p class="text-xs">&copy; 2024 Hostel Hub. All Rights Reserved</p>
                </div>
            </div>
        </footer>
    </div>
</template>
<style>
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        -webkit-backdrop-filter: saturate(180%) blur(5px);
        backdrop-filter: saturate(180%) blur(5px);
        background-color: hsla(0, 0%, 100%, 0.6);
        z-index: 10;
    }

    .bg-dots-darker {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
    }
    @media (prefers-color-scheme: dark) {
        .dark\:bg-dots-lighter {
            background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
        }
    }
</style>
