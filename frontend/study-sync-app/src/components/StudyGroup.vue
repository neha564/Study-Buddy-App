<template>
  <div>
    <h2>Groups</h2>
    <form @submit.prevent="createGroup">
      <input v-model="course" placeholder="Course" />
      <button type="submit">Create Group</button>
    </form>

    <div v-for="group in groups" :key="group._id" class="group">
      <p><strong>Course:</strong> {{ group.course }}</p>

      <button @click="showAddSession(group._id)">Add Session</button>

      <div v-if="group._id === activeGroupId">
        <form @submit.prevent="addSession(group._id)">
          <input
            v-model="sessionDate"
            type="datetime-local"
            placeholder="Date & Time"
          />
          <select v-model="sessionMood">
            <option value="study">Study</option>
            <option value="happy">Happy</option>
            <option value="calm">Calm</option>
            <option value="focus">Focus</option>
          </select>
          <button type="submit">Add Study Session</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
  data() {
    return {
      course: "",
      sessionDate: "",
      sessionMood: "study",
      activeGroupId: null,
    };
  },
  computed: {
    ...mapState(["groups"]),
  },
  methods: {
    ...mapActions(["createGroup", "fetchGroups", "createStudySession"]),

    async createGroup() {
      try {
        await this.createGroup({ course: this.course });
        this.course = "";
      } catch (error) {
        console.error("Error creating group:", error);
      }
    },

    showAddSession(groupId) {
      this.activeGroupId = this.activeGroupId === groupId ? null : groupId;
    },

    async addSession(groupId) {
      try {
        await this.createStudySession({
          groupId,
          date: this.sessionDate,
          mood: this.sessionMood,
        });
        this.sessionDate = "";
        this.sessionMood = "study";
        this.activeGroupId = null;
      } catch (error) {
        console.error("Error adding session:", error);
      }
    },
  },
  created() {
    this.fetchGroups();
  },
};
</script>

<style scoped>
.group {
  margin-bottom: 20px;
  padding: 10px;
  border: 1px solid #ddd;
}
</style>
