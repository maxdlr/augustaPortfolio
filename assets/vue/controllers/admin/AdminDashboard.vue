<script setup>
import AdminAvatar from "../../components/template/AdminAvatar.vue";

const props = defineProps({
  avatarImg: {type: Object, required: false},
  avatarFormId: {type: String}
})
</script>

<template>
  <AdminAvatar :form-id="avatarFormId" :avatar-img="avatarImg"/>
</template>

<style scoped>

</style>