<template>
    <div class="card-body form-group basic-menu">
        <ul class="basic">
            <span v-for="item in itemSourceData">
                    <li>{{item.name}}</li>
            </span>
        </ul>
    </div>
</template>
<script>
    export default {
        props: ['dataUrl','prevLevel'],
        data: function () {
            return {itemSourceData: [{'id': 0, 'name': '---'}]}
        },
        mounted() {
            this.loading = true;
            var token = localStorage.getItem('access_token');
            axios(
                {   url:this.dataUrl,
                    headers: { Authorization: "Bearer " + token}
                }
            )
            .then((response) => {
                this.loading = false;
                this.itemSourceData = response.data['data'];
            }, (error) => {
                this.loading = false;
            })
        },
    }
</script>
