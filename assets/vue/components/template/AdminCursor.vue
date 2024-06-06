<script setup>
import Button from "../../controllers/components/Button.vue";
import {Modal} from 'bootstrap';
import HelpBox from "../atom/HelpBox.vue";
import MediaThumbnail from "../atom/MediaThumbnail.vue";

const props = defineProps({
  cursorImg: {type: Object, required: false},
  formId: {type: String, required: true}
})

</script>

<template>
  <div class="position-relative pt-5 text-center">
    <div>
      <div class="position-absolute top-0 end-0 me-3 mt-3 d-flex flex-column">
        <Button
            :data-bs-target="`#${formId}`"
            color-class="warning"
            data-bs-toggle="modal"
            icon-class-start="pencil-fill"
            round-class="pill"
            type="button"
        />
      </div>
    </div>
    <MediaThumbnail :animate="false" :media="cursorImg" class="w-50 m-auto"/>
  </div>
</template>

<style scoped>

</style>