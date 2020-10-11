<template>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <b-container>
        <div class="navbar-brand">
            <a class="navbar-brand" href="#" @click="goToPage('home')">
                NosMg
            </a>
        </div>
        <div id="navbar" class="navbar-menu">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation'">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto" >
                        <li v-for="menu_item in menu_items" class="nav-item" :active="menu_item.active" :key="menu_item.label">
                            <a class="nav-link" href="#" @click="menu_item.action">{{ $t(menu_item.label) }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </b-container>
</nav>
</template>

<script>
export default {
    name: 'Mymenu',
    computed: {
        menu_items() {
            //console.log('menu_items')
            let items = []
            if (this.$store.token) {
                items.push(
                    {
                        label: 'invitations',
                        action: () => this.$router.push({name: 'invitations'}).catch(err => err),
                        active: this.$route.name == 'invitations',
                    },
                    {
                        label: 'activities',
                        action: () => this.$router.push({name: 'activities'}).catch(err => err),
                        active: this.$route.name == 'activities',
                    },
                    {
                        label: 'players',
                        action: () => this.$router.push({name: 'players'}).catch(err => err),
                        active: this.$route.name == 'players',
                    },
                    {
                        label: 'logout',
                        action: () => this.$store.logout(),
                        active: this.$route.name == 'logout',
                    },
                );
            } else {
                items.push({
                    label: 'login',
                    action: () => this.$router.push({name: 'login'}).catch(err => err),
                    active: this.$route.name == 'login',
                },
                {
                    label: 'register',
                    action: () => this.$router.push({name: 'register'}).catch(err => err),
                    active: this.$route.name == 'register',
                })
            }
            return items
        }
    },
    methods: {
        goToPage(name) {
            this.$router.push({
                name
            }).catch(err => err)
        },
    }
}
</script>

<style lang="scss" scoped>
nav {
    // margin-top: 5px;
    margin-bottom: 30px;
    .nav-item {
        font-weight: bold;
        // .nav-link {
        //     color: #f00;
        // }
        &:hover,
        &[active] {
            .nav-link {
                color: rgba(0, 0, 0, 0.8);
            }
            // color: #d88d00;
         }
         &:hover{
             .nav-link{
                 text-decoration: underline;
             }
         }
    }
}
</style>
