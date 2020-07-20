<template>
  <div>
    <div class="wrapper">
      <div class="image-wrapper" v-for="image in this.images" :key="image.id">
        <img
          class="image"
          :src="`${image.post_image_path}`"
          alt=""
          @click="clickedImage(image)"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {
    // ImageSlider
  },
  props: ["images"],
  data() {
    return {
      showSlider: false,
      activeImage: ""
    };
  },
  watch: {
    activeImage() {
      if (this.activeImage) {
        let data = {
          images: this.images,
          activeImage: this.activeImage
        };
        this.$root.$emit("slider-images", data);
        setTimeout(() => {
          this.activeImage = "";
        }, 300);
      }
    }
  },
  methods: {
    clickedImage(image) {
      this.activeImage = image;
    }
  }
};
</script>

<style lang="scss" scoped>
.wrapper {
  display: flex;
}

.image-wrapper {
  width: 200px;
  height: 200px;
  margin: 10px;
  .image {
    width: 100%;
    height: auto;
  }
}
</style>
