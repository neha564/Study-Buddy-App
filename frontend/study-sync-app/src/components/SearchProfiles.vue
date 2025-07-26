<template>
  <div>
    <h2>Search Profiles</h2>
    <input
      v-model="query"
      placeholder="Search by name"
      @input="searchProfiles"
    />
    <div v-for="profile in profiles" :key="profile._id">
      <p>{{ profile.name }}</p>
      <p>{{ profile.courses.join(", ") }}</p>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
  data() {
    return { query: "" };
  },
  computed: { ...mapState(["profiles"]) },
  methods: { ...mapActions(["searchProfiles"]) },
  created() {
    this.searchProfiles("");
  },
};
</script>
