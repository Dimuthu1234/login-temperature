<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

            <div class="mt-8 text-2xl">
                Welcome to your Login Temperatures
            </div>
            <hr>

            <div class="mt-6 flex flex-row-reverse">
                <button
                    @click="getTemperatures"
                    class="ml-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Reset Order
                </button>
                <button
                    @click="getHottestFirst"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Hottest First
                </button>
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
            <div class="p-6" v-for="city in cities" :key="city.id">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-map-pin">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="https://laravel.com/docs">{{ city.name }}
                    </a>
                    </div>
                </div>
                <div class="mt-6 flex flex-row">
                    <table class="w-full border">
                        <thead>
                        <tr>
                            <th class="w-1/2 ..."></th>
                            <th class="w-1/4 ..."></th>
                            <th class="w-1/4 ..."></th>
                        </tr>
                        </thead>
                        <tbody v-for="temperature in temperatures" :key="temperature.id">
                        <tr v-if="temperature.city_id == city.id">
<!--                            <td>{{ dayjs(temperature.created_at).format('{YYYY} MM-DDTHH:mm:ss SSS [Z] A') }}</td>-->
                            <td>{{ setDateFormat(temperature.created_at) }}</td>
                            <td>{{ temperature.celsius }} °C</td>
                            <td>{{ temperature.fahrenheit }} °F</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
import Button from "@/Jetstream/Button";
import Input from "@/Jetstream/Input";
import dayjs from "dayjs"

export default {
    components: {
        Input,
        Button,
        JetApplicationLogo,
    },
    data() {
        return {
            cities: [],
            temperatures: [],
        }
    },

    mounted() {
        this.getCities();
        this.getTemperatures();
    },

    methods: {
        getCities() {
            axios.get(route('city.index'))
                .then(response => {
                    this.cities = response.data
                })
        },

        getTemperatures(){
            axios.get('api/temperature?filterBy=chronological&userId=' + this.$page.props.user.id)
                .then(response => {
                    this.temperatures = response.data
                })
        },

        getHottestFirst(){
            axios.get('api/temperature?filterBy=hottestfirst&userId=' + this.$page.props.user.id)
                .then(response => {
                    this.temperatures = response.data
                })
        },

        setDateFormat(date){
            return dayjs(date).format('ddd, DD MMM YYYY, HH:mm:ss')
        }
    }
}
</script>
