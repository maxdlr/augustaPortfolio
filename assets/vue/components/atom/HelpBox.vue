<script setup>
import Button from "../../controllers/components/Button.vue";
import {onBeforeMount, ref} from "vue";
import {SLIDE_LEFT} from "../../constant/animation";

const props = defineProps({
  instructions: {type: Array, required: true},
  startCollapsed: {type: Boolean, default: false, required: false}
})

onBeforeMount(() => {
  isDisplayOn.value = !props.startCollapsed
})

const isDisplayOn = ref();

</script>

<template>
  <div>
    <TransitionGroup :name="SLIDE_LEFT">
      <div v-if="isDisplayOn" class="card d-inline-block rounded-4">
        <div class="card-header justify-content-between align-items-center d-flex">
          <div>
            L'aide de Max ❤️
          </div>
          <div>
            <Button
                class="text-danger"
                color-class=""
                custom-pointer
                icon-class-end="x-circle-fill"
                @click.prevent="isDisplayOn = false"
            />
          </div>
        </div>

        <div class="card-body">

          <ul class="list-group list-group-flush rounded-4">
            <li v-for="(item, index) in instructions" :key="index" class="list-group-item text-start">
              👉 <span class="fst-italic">{{ item }}</span>
            </li>
          </ul>
        </div>
      </div>
      <div v-else>
        <Button
            class="text-secondary"
            color-class=""
            custom-pointer
            icon-class-end="info-circle-fill"
            size="lg"
            @click.prevent="isDisplayOn = true"
        />
      </div>
    </TransitionGroup>
  </div>
</template>

<style lang="scss" scoped>
@import "../../../styles/slide-left";

</style>
