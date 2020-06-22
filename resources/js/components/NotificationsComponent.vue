<template>
  <div class="container">
    <li class="nav-item dropdown">
      <button
        class="dropdown-toggle btn btn-danger btn-sm"
        data-toggle="dropdown"
        role="button"
        aria-expanded="false"
      >
        <i class="fa fa-bell"></i>
        <span class="badge badge-light" v-if="notifications.length > 0">{{ notifications.length }}</span>
      </button>

      <ul
        class="dropdown-menu dropdown-menu-notifications"
        role="menu"
        v-if="notifications.length > 0"
      >
        <li v-for="(notification, index) in notifications" :key="index">
          <div class="container notification_parent mt-2 pa-3">
            <div>
              <b>OrderId:</b>
              {{ notification.order_id }}
            </div>
            <div>
              <b>Status:</b>
              <span class="text-success">
                {{
                notification.status
                }}
              </span>
            </div>
            <div>{{ notification.time }}</div>
            <br />
          </div>
        </li>
      </ul>
      <ul v-else class="dropdown-menu dropdown-menu-notifications" role="menu">
        <li>No notiications</li>
      </ul>
    </li>
  </div>
</template>

<script>
import moment from "moment";
export default {
  name: "Notifications",
  data() {
    return {
      notifications: []
    };
  },
  props: ["user_id"],
  mounted() {
    console.log("notifications mounted");
    Echo.channel("pizza-tracker").listen("OrderStatusUpdated", e => {
      if (this.user_id == e.order.user_id) {
        this.notifications.unshift({
          order_id: e.order.id,
          status: e.order.status_string,
          time: moment(new Date()).format("LT")
        });
      }
    });
  },
  methods: {
    moment: moment
  }
};
</script>

<style>
.notification_parent {
  border-bottom: 1px solid lightgray;
}
</style>
