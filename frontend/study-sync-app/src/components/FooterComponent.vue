<template>
  <v-footer color="indigo darken-4" dark>
    <v-container fluid>
      <v-row justify="center" align="center" class="footer-content" style="margin: 0; padding: 0;">
        <!-- Footer Text -->
        <v-col cols="12" md="6" class="text-center footer-text" style="margin-bottom: 0;">
          <p>&copy; {{ currentYear }} StudySync. All rights reserved.</p>
        </v-col>
        <!-- Social Media Icons -->
        <v-col cols="12" md="6" class="text-center footer-icons" style="padding-top: 8px;">
          <a
            href="https://github.com/neha564"
            target="_blank" rel="noopener noreferrer"
            class="footer-icon-link"
          >
            <v-icon small class="footer-icon">mdi-github</v-icon>
          </a>
          <a
            href="mailto:nneha8157@gmail.com"
            target="_blank" rel="noopener noreferrer"
            class="footer-icon-link"
          >
            <v-icon small class="footer-icon">mdi-email</v-icon>
          </a>
          <a
            href="https://www.linkedin.com/in/neha-hafeez-2160631a0?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"
            target="_blank" rel="noopener noreferrer"
            class="footer-icon-link"
          >
            <v-icon small class="footer-icon">mdi-linkedin</v-icon>
          </a>
        </v-col>
      </v-row>
    </v-container>
  </v-footer>
</template>

<script>
export default {
  name: "FooterComponent",
  data() {
    return {
      currentYear: new Date().getFullYear(), // Dynamically fetch current year
    };
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

.v-footer {
  padding: 0.25em 0 !important;
  min-height: auto !important;
  border-top: 1px solid rgba(255, 255, 255, 0.2);
  background-color: #3a3a9e;
}

.v-container {
  padding-left: 0 !important;
  padding-right: 0 !important;
}

.footer-content {
  max-width: 100%;
  margin: 0 !important;
  padding: 0 !important;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.footer-text {
  margin-bottom: 0 !important;
}

.footer-text p {
  margin: 0 !important;
  font-size: 1em;
  font-family: "Poppins", sans-serif;
  color: #ffffff;
  font-weight: 500;
  line-height: 1.2;
}

.footer-icons {
  display: flex;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
  padding-top: 8px;
}

.footer-icon {
  color: #ffffff;
  transition:
    color 0.3s ease,
    transform 0.2s ease;
  font-size: 1.5em;
  cursor: pointer;
}

.footer-icon:hover {
  color: #ffeb3b;
  transform: scale(1.1);
}

/* Responsive */
@media (max-width: 600px) {
  .footer-text p {
    font-size: 0.9em;
  }

  .footer-icons {
    gap: 15px;
    margin-top: 10px;
  }

  .footer-icon {
    font-size: 1.3em;
  }
}

@media (min-width: 601px) {
  .footer-text p {
    font-size: 1em;
  }

  .footer-icon {
    font-size: 1.5em;
  }
}
</style>
