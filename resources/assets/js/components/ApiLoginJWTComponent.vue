<template>
    <div>
        Email: <input name="email"  type="email" v-model="email"/>
        Password: <input name="password" type="password" v-model="password"/>
        <button id="call-login" v-on:click="callLoginAPI">Login</button>
        <button id="call-logout" v-on:click="callLogoutAPI">Logout</button>
    </div>

</template>
<script>
    export default {
        props: ['actionUrl'],
        data:function(){
            return {email:'',password:''};
        },
        methods:{
            callLoginAPI:function() {
                this.loading = true;

                axios.get(this.actionUrl,{params: {
                        email:this.email,password:this.password
                    }}
                ).then((response) => {
                        this.loading = false;
                        if(response.data['data']['access_token']){
                            var storageKey =  'access_token';
                            localStorage.setItem(storageKey,response.data['data']['access_token']);
                        }
                    }, (error) => {
                        this.loading = false;
                    })
            },
            callLogoutAPI:function() {
                this.loading = true;
                var token = localStorage.getItem('access_token');
                axios({url:'http://localhost:8081/api/auth/logout',headers: { Authorization: "Bearer " + token}}
                ).then((response) => {
                    this.loading = false;


                }, (error) => {
                    this.loading = false;
                })
            }
        }
    }

</script>
