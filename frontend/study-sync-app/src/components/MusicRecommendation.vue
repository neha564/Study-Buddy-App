<template>
  <div>
    <h2>Music Recommendation</h2>
    <select v-model="mood" @change="fetchMusic">
      <option value="study">Study</option>
      <option value="happy">Happy</option>
      <option value="sad">Sad</option>
    </select>
    <ul>
      <li v-for="track in tracks" :key="track.spotify_url">
        <a :href="track.spotify_url">{{ track.name }} by {{ track.artist }}</a>
      </li>
    </ul>
  </div>
</template>

<script>
import api from "../api";

export default {
  data() {
    return { mood: "study", tracks: [] };
  },
  methods: {
    async fetchMusic() {
      const response = await api.get(`/music?mood=${this.mood}`);
      this.tracks = response.data;
    },
  },
};
</script>
