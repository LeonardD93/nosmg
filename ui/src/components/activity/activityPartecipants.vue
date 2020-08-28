<template>
<div>

</div>
</template>
<script>
export default {
    name: 'activityPartecipants',
    props: {
        activity: {
            type: Object,
            required: true,
        }
    },
    data() {
        return {
            form: this.activity ? this.$store.clone(this.activity) : {
                // extra_params:{}
            },
        }
    },
    created() {
        if (!localStorage.getItem('token'))
            this.$router.push('login')
    },
    methods: {
        showModal(modal_name) {
            this.$root.$emit('bv::show::modal', modal_name, '#btnShow')
        },
    },
}
