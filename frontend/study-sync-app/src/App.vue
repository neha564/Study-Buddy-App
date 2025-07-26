<template>
  <v-app>
    <Navbar />
    <v-main class="main-content"> </v-main>
    <Footer />
  </v-app>
</template>

<script>
import Navbar from "./components/NavbarComponent.vue";
import Footer from "./components/FooterComponent.vue";

export default {
  components: {
    Navbar,
    Footer,
  },
};
</script>

<style scoped>
.main-content {
  min-height: calc(
    100vh - 128px
  ); /* Viewport height minus navbar and footer height */
  padding-top: 64px; /* Space for the fixed navbar */
  padding-bottom: 64px; /* Space for the footer */
  display: flex;
  justify-content: center;
  align-items: center;
  box-sizing: border-box;
}
</style>
