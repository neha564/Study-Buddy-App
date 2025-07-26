const mongoose = require("mongoose");

const userSchema = new mongoose.Schema({
  name: { type: String, required: true },
  email: { type: String, required: true, unique: true },
  password: { type: String, required: true },
  avatar: { type: String, default: null },
  interests: { type: [String], default: [] },
  availableTimes: { type: [String], default: [] },
  courses: { type: [String], default: [] },
  mood: { type: String, default: "happy" },
  groups: [{ type: mongoose.Schema.Types.ObjectId, ref: "Group" }],
});

const groupSchema = new mongoose.Schema({
  members: [{ type: mongoose.Schema.Types.ObjectId, ref: "User" }],
  course: String,
  studySessions: [
    {
      date: Date,
      musicMood: String,
    },
  ],
});

const User = mongoose.model("User", userSchema);
const Group = mongoose.model("Group", groupSchema);

module.exports = { User, Group };

