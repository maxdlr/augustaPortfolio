<script setup>
import AdminAvatar from "../../components/template/AdminAvatar.vue";
import AdminCursors from "./AdminCursors.vue";

const props = defineProps({
  avatarImg: {type: Object, required: false},
  avatarFormId: {type: String},
  cursorImgs: {type: Object, required: true},
  cursorFormIds: {type: Array}
})
</script>

<template>
  <section>
    <div class="row row-cols-2">
      <AdminAvatar :avatar-img="avatarImg" :form-id="avatarFormId"/>
    </div>
  </section>
  <AdminCursors :cursor-form-ids="cursorFormIds" :cursor-imgs="cursorImgs" class="mt-3"/>
</template>