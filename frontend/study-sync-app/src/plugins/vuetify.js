// src/plugins/vuetify.js
import "vuetify/styles"; // Vuetify styles
import { createVuetify } from "vuetify";
import { mdi } from "vuetify/iconsets/mdi";

export default createVuetify({
  icons: {
    defaultSet: "mdi",
    sets: {
      mdi,
    },
  },
  theme: {
    themes: {
      light: {
        colors: {
          primary: "#1976D2",
          secondary: "#424242",
          accent: "#82B1FF",
          error: "#FF5252",
          info: "#2196F3",
          success: "#4CAF50",
          warning: "#FB8C00",
        },
      },
    },
  },
});
