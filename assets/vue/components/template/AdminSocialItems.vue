<script setup>
import AdminDashboardWidget from "./AdminDashboardWidget.vue";
import Button from "../../controllers/components/Button.vue";
import {goTo} from "../../composable/action/redirect";

const props = defineProps({
  socialItems: {type: Object}
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
    <template v-for="(socialItem, index) in socialItems" :key="index" #[distributeContentSlot(index)]>
      <div v-if="socialItem" class="w-25 mx-auto">
        <Button :icon-class-start="socialItem.icon" @click.prevent="goTo(socialItem.link)"/>
      </div>
    </template>

    <template v-for="(socialItem, index) in socialItems" :key="index" #[distributeButtonsSlot(index)]>
      <Button
          :color-class="socialItem ? 'warning' : 'primary'"
          :data-bs-target="`#socialItemForm-${socialItem.id}`"
          :icon-class-start="socialItem ? 'pencil-fill' : 'plus-circle-fill'"
          :label="socialItem ? 'modifier' : 'ajouter'"
          data-bs-toggle="modal"
          round-class="pill"
          type="button"
      />
    </template>
  </AdminDashboardWidget>
</template>