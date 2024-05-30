<script setup>
import {toTitle} from "../../composable/formatter/string";
import {ref} from "vue";
import {SLIDE_LEFT} from "../../constant/animation";
import Button from "../../controllers/components/Button.vue";

const props = defineProps({
  item: {type: Object, required: true},
  hoverAction: {type: Boolean, default: false, required: false}
})

const hovering = ref();
</script>

<template>
  <div :class="{'animate-slide-right': hoverAction}"
       class="position-relative"
       @mouseenter="hovering = true"
       @mouseleave="hovering = false"
  >
    <Transition :name="SLIDE_LEFT">
      <Button
          v-if="hovering && hoverAction"
          class="position-absolute start-0 top-50 translate-middle text-primary"
          color-class=""
          icon-class-start="arrow-right-circle-fill"
      />
    </Transition>
    <div class="p-2 pt-3 px-4 rounded-5">
      <a
          :href="item.link"
          class="link-underline link-underline-opacity-0"
      >
        <h6 class="fs-6 m-0 text-nowrap">
          <span class="fs-title">{{ toTitle(item.title) + ' ' }}</span>
          <span>@{{ item.labelLink }}</span>
        </h6>
        <div>
          <span class="ps-2 d-inline-block text-truncate" style="max-width: 350px;">{{ item.description }}</span>
        </div>
      </a>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@import '../../../styles/slide-left';
@import '../../../styles/animation';

.animate-slide-right {
  & div {
    transition: transform $duration $timing
  }

  &:hover {
    & div {
      transform: translateX(30px);
    }
  }
}

</style>