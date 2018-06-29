<template>
    <button type="submit" class="btn btn-danger btn-block" v-on:click="confirmDeletion">
        Delete User
    </button>
</template>

<script>
    export default {
        methods: {
            confirmDeletion: function (event) {
                event.preventDefault()
                const confirmDelete = confirm('Are you sure you want to delete your account? You will not be able restore your account after.')
                if (confirmDelete === true)
                    document.getElementById('delete_form').submit()
            }
        }
    }
</script>
