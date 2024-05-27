<script setup>
import AdminAvatar from "../../components/template/AdminAvatar.vue";

const props = defineProps({
  avatarImg: {type: Object, required: false},
  avatarFormId: {type: String}
})
</script>

<template>
  <section class="row row-cols-2">
  <AdminAvatar :form-id="avatarFormId" :avatar-img="avatarImg"/>
  </section>
</template>

<style scoped>

</style>