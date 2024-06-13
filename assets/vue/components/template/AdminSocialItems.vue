<script setup>
import AdminDashboardWidget from "./AdminDashboardWidget.vue";
import Button from "../../controllers/components/Button.vue";
import SocialItem from "../atom/SocialItem.vue";
import {onBeforeMount, onMounted, ref} from "vue";

const props = defineProps({
  socialItems: {type: Object}
})
const site = window.location.origin;
const filteredSocialItems = ref({})
const emit = defineEmits(['toast'])


onBeforeMount(() => {
  for (const key in props.socialItems) {
    filteredSocialItems.value[props.socialItems[key].id] = props.socialItems[key]
  }
})

const deleteSocialItem = async (id, icon) => {
  if (confirm('Sure de vouloir supprimer le lien ' + icon + ' ?')) {
    await fetch(`${site}/social-item/${id}/delete`)
        .then(r => r.json().then(data => ({ok: r.ok, body: data}))
            .then(obj => {
              if (obj.ok) {
                emit('toast', 'Lien ' + icon + ' supprimée.', 'success')
                delete filteredSocialItems.value[id]
              }
            }));
  }
}

</script>

<template>
  <AdminDashboardWidget :columns="false" title="Mes réseaux sociaux">
    <template #headerButton>
      <Button
          color-class="primary"
          data-bs-target="#newSocialItemForm"
          data-bs-toggle="modal"
          icon-class-start="plus-circle-fill"
          label="ajouter"
          round-class="pill"
          type="button"
      />
    </template>

    <template :key="index" #content1>
      <div v-for="socialItem in filteredSocialItems">
        <div v-if="socialItem" class="row align-items-center my-2">
          <div class="col">
            <SocialItem :social-item="socialItem"/>
          </div>
          <div class="col">
            <Button
                :color-class="socialItem ? 'warning' : 'primary'"
                :data-bs-target="`#socialItemForm-${socialItem.id}`"
                :icon-class-start="socialItem ? 'pencil-fill' : 'plus-circle-fill'"
                :label="socialItem ? 'modifier' : 'ajouter'"
                data-bs-toggle="modal"
                round-class="pill"
                type="button"
            />
          </div>
          <div class="col">
            <Button
                color-class="danger"
                icon-class-start="trash-fill"
                label="supprimer"
                round-class="pill"
                type="button"
                @click.prevent="deleteSocialItem(socialItem.id, socialItem.icon)"
            />
          </div>
        </div>
      </div>
    </template>
  </AdminDashboardWidget>
</template>