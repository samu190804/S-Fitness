<script setup lang="ts">
interface Props {
  section: string
  info?: string
}

const props = withDefaults(defineProps<Props>(), {
  section: '',
  info: ''
})
</script>

<template>
  <div class="row" id="seccion">
    <h1>{{ section }}</h1>
    <p>{{ info }}</p>
  </div>
</template>

