<template>
    <form ref="bottonForm" :action="this.route" method="post" id="bottonForm">
        <slot></slot>
    </form>
</template>


<script>
export default {
    data: () => {
        return {
            route: null
        }
    },
    mounted() {
        this.$root.$on('botton-item', data => {
            this.route = data.route;
            this.showConfirmationDialog();
        })
    },
    methods: {
        showConfirmationDialog () {
            this.$buefy.dialog.confirm({
                title: 'Are you sure?',
                message: 'This action cannot be undone',
                confirmText: 'Yes',
                cancelText: 'No',
                type: 'is-danger',
                hasIco: true,
                onConfirm: () => this.bottonItem()
            })
        },
        bottonItem () {
            this.$refs.bottonForm.submit();
        },
         reverseMessages: function (){
             this.message = this.message.split('').reverse()
         }
    }
}
</script>