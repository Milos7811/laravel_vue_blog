<template>
  <div
    class="image-slider-wrapper"
    v-if="sliderImages && showSlider"
    @keydown.esc="showSlider = false"
  >
    <div class="background"></div>
    <div class="image-wrapper-preview">
      <a href="#" @click="(showSlider = false), resetData()" class="close-icon">
        x
      </a>
      <transition name="fade" tag="div" mode="out-in">
        <div class="image-wrapper" v-for="i in [currentIndex]" :key="i">
          <img class="image" :src="currentImg.post_image_path" />
        </div>
      </transition>
      <a class="prev" @click="prev" href="#">&#10094; </a>
      <a class="next" @click="next" href="#">&#10095; </a>
    </div>
  </div>
</template>
<script>
export default {
  name: "Slider",
  data() {
    return {
      showSlider: true,
      timer: null,
      currentIndex: 0,
      clickedImage: "",
      sliderImages: ""
    };
  },

  mounted() {
    this.$root.$on("slider-images", data => {
      this.sliderImages = data.images;
      this.clickedImage = data.activeImage;
      this.showSlider = true;
      this.choseActiveImage();
    });
  },

  methods: {
    choseActiveImage() {
      this.sliderImages.forEach((element, index) => {
        if (element.id == this.clickedImage.id) {
          this.currentIndex = index;
        }
      });
    },
    resetData() {
      (this.sliderImages = []), (this.images = "");
    },
    startSlide: function() {
      this.timer = setInterval(this.next, 4000);
    },

    next: function() {
      this.currentIndex += 1;
    },
    prev: function() {
      this.currentIndex -= 1;
    }
  },

  computed: {
    currentImg: function() {
      return this.sliderImages[
        Math.abs(this.currentIndex) % this.sliderImages.length
      ];
    }
  }
};
</script>

<style lang="scss" scoped>
.close-icon {
  color: white;
  font-size: 30px;
  position: absolute;
  right: 10px;
  cursor: pointer;
  transition: none;
  user-select: none;
  &:hover {
    color: darken(white, 20%);
  }
}
.background {
  width: 100%;
  height: 100%;
  background-color: black;
  opacity: 0.7;
}
.image-wrapper-preview {
  width: 600px;
  height: 600px;
  position: absolute;
  margin-top: 15%;
}
.image-slider-wrapper {
  width: 100vw;
  height: 100vw;
  position: fixed;
  top: 0px;
  left: 0px;
  display: flex;
  justify-content: center;
}
.image-slider {
  width: 600px;
  height: 600px;
  position: absolute;
  left: 25%;
  top: 25%;
}
.image-wrapper {
  width: 600px;
  height: auto;
  .image {
    width: 100%;
    height: auto;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
  }
}
.fade-enter-active,
.fade-leave-active {
  transition: all 0.9s ease;
  overflow: hidden;
  visibility: visible;
  position: absolute;
  width: 100%;
  opacity: 1;
}

.fade-enter,
.fade-leave-to {
  visibility: hidden;
  width: 100%;
  opacity: 0;
}

img {
  height: 600px;
  width: 100%;
}

.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 30%;
  width: auto;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.7s ease;
  border-radius: 0 4px 4px 0;
  text-decoration: none;
  user-select: none;
}

.next {
  right: 0;
}

.prev {
  left: 0;
}

.prev:hover,
.next:hover {
  color: darken(white, 20%);
}
</style>
