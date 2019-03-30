<template>
    <ul class="browser-list list-inline">
        <li class="list-inline-item" v-for="browser in browsers"><b>{{browser.browser_name}}</b> : {{browser.total}} </li>
    </ul>
</template>

<script>
    export default {
        data() {
            return {
                browsers: []
            };
        },
        created: function () {
            axios.get('/browsers/')
                .then((response) => {
                    this.browsers = response.data;
                })
                .catch((error) => {
                    console.log(error)
                });
        },
    }
</script>

