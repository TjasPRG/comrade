<template>
    <div class="bg-white h-12 px-4 flex items-center border-b border-gray-300 shadow-sm">
        <div class="w-1/3">
            <div class="flex items-center">
                <router-link to="/">
                    <h1 class="text-xl font-bold tracking-tight">
                        <span v-if="appBranding" class="font-normal">
                            {{ appBranding }}
                        </span>
                        {{ appName }}
                    </h1>
                </router-link>

                <div class="ml-4 relative">
                    <div class="absolute py-1 px-2">
                        <i class="icofont-search text-gray-500"></i>
                    </div>
                    <input type="text"
                           name="search"
                           :placeholder="'Search ' + appName"
                           autocomplete="off"
                           class="rounded-full pl-8 w-56 h-8 bg-gray-200 border-2 border-gray-200 focus:border-blue-300 focus:outline-none text-sm">
                </div>
            </div>
        </div>
        <div class="w-1/3 flex justify-center items-center h-full">
            <router-link to="/" class="h-full px-6 border-b-2 border-white group flex items-center hover:border-red-600">
                <i class="icofont-home text-3xl text-gray-500 group-hover:text-gray-700"></i>
            </router-link>
            <router-link :to="'/users/' + authUser.data.user_id" class="h-full px-6 border-b-2 border-white flex items-center hover:border-red-600">
                <img :src="authUser.data.attributes.profile_image.data.attributes.path" alt="User avatar" class="w-8 h-8 object-cover rounded-full">
            </router-link>
            <router-link to="/notifications" class="h-full px-6 border-b-2 border-white group flex items-center hover:border-red-600">
                <i class="icofont-notification text-3xl text-gray-500 group-hover:text-gray-700"></i>
            </router-link>
        </div>
        <div class="w-1/3 flex justify-end items-center h-full">
            <button class="h-full flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                <i class="icofont-gear text-3xl"></i>
            </button>
        </div>
    </div>
</template>

<script>
    import { mapGetters} from 'vuex';

    export default {
        name: "Nav",

        data() {
            return {
                appBranding: process.env.MIX_APP_BRANDING,
                appName: process.env.MIX_APP_NAME || ""
            }
        },

        computed: {
            ...mapGetters({
                authUser: 'authUser'
            })
        }
    }
</script>

<style scoped>

</style>