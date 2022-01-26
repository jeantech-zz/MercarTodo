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
                title: 'Aggre this product',
                message: 'You additial this product your order',
                confirmText: 'Yes',
                cancelText: 'No',
                type: 'is-primary is-light',
                hasIco: true,
                onConfirm: () => this.bottonItem()
            })
        },
        bottonItem () {
            this.$refs.bottonForm.submit();
        }
    }
}
</script>