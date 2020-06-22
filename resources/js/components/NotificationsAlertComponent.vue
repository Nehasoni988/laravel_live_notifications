<template>
  <alert
    v-if="showAlert"
    placement="top-right"
    :duration="4000"
    :type="order_id % 2 == 0 ? 'danger' : 'success'"
    width="400px"
    dismissable
  >
    <span class="icon-ok-circled alert-icon-float-left"></span>
    <p v-if="order_id">
      Your order &ensp;
      <strong>Id:{{ order_id }}</strong>&ensp;has been&ensp;
      <strong>{{ order_status }}</strong>
    </p>
  </alert>
</template>

<script>
import { alert } from "vue-strap";

export default {
  data() {
    return {
      showAlert: false,
      order_id: null,
      order_status: null
    };
  },
  components: {
    alert
  },

  props: ["user_id"],

  mounted() {
    Echo.channel("pizza-tracker").listen("OrderStatusUpdated", e => {
      if (this.user_id == e.order.user_id) {
        this.showAlert = true;
        this.order_id = e.order.id;
        this.order_status = e.order.status_string;
      }
    });
  }
};
</script>
