<script setup>
import AdminAvatar from "../../components/template/AdminAvatar.vue";
import AdminCursors from "./AdminCursors.vue";
import AdminShowreel from "../../components/template/AdminShowreel.vue";
import AdminMeuf from "../../components/template/AdminMeuf.vue";

const props = defineProps({
  avatarImg: {type: Object, required: false},
  avatarFormId: {type: String},
  showreelImg: {type: Object, required: false},
  showreelFormId: {type: String},
  meufImg: {type: Object, required: false},
  meufFormId: {type: String},
  cursorImgs: {type: Object, required: true},
  cursorFormIds: {type: Array}
})
</script>

<template>
  <section>
    <div class="row row-cols-1 row-cols-md-2">
      <AdminAvatar :avatar-img="avatarImg" :form-id="avatarFormId"/>
      <AdminShowreel :form-id="showreelFormId" :showreel-img="showreelImg"/>
      <AdminMeuf :form-id="meufFormId" :meuf-img="meufImg"/>
    </div>
  </section>
  <AdminCursors :cursor-form-ids="cursorFormIds" :cursor-imgs="cursorImgs" class="mt-3"/>
</template>