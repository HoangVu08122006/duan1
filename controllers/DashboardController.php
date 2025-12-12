<?php
class DashboardController {
    public function index() {
        $model = new DashboardModel();
        $data = [
            'activeTours'       => $model->countActiveTours(),
            'bookingStats'      => $model->getBookingStats(),
            'upcomingDepartures'=> $model->getUpcomingDepartures(),
            'monthlyRevenue'    => $model->getMonthlyRevenue(),
            'tourAlerts'        => $model->getTourAlerts()
        ];
        // Truyền $data sang view
        include './views/admin/dashboard.php';
    }
}
