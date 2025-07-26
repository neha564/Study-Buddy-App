import { createStore } from "vuex";
import api from "../api";

export default createStore({
  state: {
    user: null,
    profiles: [],
    groups: [],
    token: localStorage.getItem("token") || null,
  },
  mutations: {
    SET_USER(state, user) {
      state.user = user;
    },
    SET_PROFILES(state, profiles) {
      state.profiles = profiles;
    },
    SET_GROUPS(state, groups) {
      state.groups = groups;
    },
    SET_TOKEN(state, token) {
      state.token = token;
      localStorage.setItem("token", token);
    },
    CLEAR_SESSION(state) {
      state.user = null;
      state.token = null;
      localStorage.removeItem("token");
    },
  },
  actions: {
    /* eslint-disable-next-line no-unused-vars */
    async register({ commit }, userData) {
      const { name, email, password } = userData;
      const response = await api.post("/auth/register", {
        name,
        email,
        password,
      });
      console.log(response.data.message);
    },
    async login({ commit }, credentials) {
      const response = await api.post("/auth/login", credentials);
      commit("SET_TOKEN", response.data.token);
    },
    async fetchUserProfile({ commit }) {
      const response = await api.get("/profile");
      commit("SET_USER", response.data);
    },
    async searchProfiles({ commit }, query) {
      const response = await api.get(`/search?q=${query}`);
      commit("SET_PROFILES", response.data);
    },
    async fetchGroups({ commit }) {
      const response = await api.get("/groups");
      commit("SET_GROUPS", response.data);
    },
    async createGroup({ dispatch }, groupData) {
      await api.post("/groups", groupData);
      dispatch("fetchGroups");
    },
    async createStudySession({ dispatch }, { groupId, date, mood }) {
      await api.post(`/groups/${groupId}/sessions`, { date, mood });
      dispatch("fetchGroups");
    },
    async logout({ commit }) {
      commit("CLEAR_SESSION");
    },
  },
  getters: {
    isAuthenticated: (state) => !!state.token,
  },
});
