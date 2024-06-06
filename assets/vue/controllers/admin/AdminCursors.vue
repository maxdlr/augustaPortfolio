<script setup>
import AdminCursor from "../../components/template/AdminCursor.vue";
import HelpBox from "../../components/atom/HelpBox.vue";

const props = defineProps({
  cursorImgs: {type: Object, required: true},
  cursorFormIds: {type: Array}
})
</script>

<template>
  <div class="bg-white shadow rounded-5 position-relative pt-5 ps-0 p-3">
    <p class="position-absolute top-0 start-0 fs-4 fw-bold text-info m-0 ms-3 mt-3">Mes curseurs</p>
    <div :class="`row-cols-sm-${Object.keys(cursorImgs).length}`" class="row">
      <div v-for="(cursorImg, index) in cursorImgs" class="p-2">
        <AdminCursor
            :cursor-img="cursorImg"
            :form-id="cursorFormIds[index]"
        />
      </div>
    </div>
    <div class="text-start">
      <HelpBox :instructions="[
      'Acceptés: .jpeg, .png, .webp, .gif',
        'L\'cursor est centré, donc si tu mets un format carré, t\'es tranquille'
    ]" :start-collapsed="true"
      />
    </div>
  </div>
</template>