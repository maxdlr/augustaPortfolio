<script setup>
import HelpBox from "../../components/atom/HelpBox.vue";
import AdminDashboardWidget from "../../components/template/AdminDashboardWidget.vue";
import MediaThumbnail from "../../components/atom/MediaThumbnail.vue";
import Button from "../components/Button.vue";

const props = defineProps({
  cursorImgs: {type: Object, required: true},
  cursorFormIds: {type: Array}
})

const distributeContentSlot = (index) => {
  return 'content' + (index + 1)
}
const distributeButtonsSlot = (index) => {
  return 'buttons' + (index + 1)
}

</script>

<template>
  <AdminDashboardWidget title="Mes curseurs">
    <template v-for="(cursorImg, index) in cursorImgs" :key="index" #[distributeContentSlot(index)]>
      <div class="w-50 mx-auto">
        <MediaThumbnail :animate="false" :media="cursorImg"/>
      </div>
    </template>

    <template v-for="(_, index) in cursorImgs" :key="index" #[distributeButtonsSlot(index)]>
      <Button
          :data-bs-target="`#${cursorFormIds[index]}`"
          color-class="warning"
          data-bs-toggle="modal"
          icon-class-start="pencil-fill"
          label="modifier"
          round-class="pill"
          type="button"
      />
    </template>

    <template #footer>
      <div class="text-start">
        <HelpBox :instructions="[
        'Acceptés: .jpeg, .png, .webp, .gif',
          'Taille maximale: 50px / 50px'
      ]" :start-collapsed="true"
        />
      </div>
    </template>
  </AdminDashboardWidget>
</template>