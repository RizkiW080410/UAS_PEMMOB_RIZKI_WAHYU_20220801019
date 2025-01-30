import '../pages/welcome.dart';
import 'package:get/get.dart';
import '../pages/login.dart';
import '../pages/dashboard.dart';
import '../pages/profile.dart';
import '../pages/pertandingan.dart';
import '../pages/ranking.dart';

class AppRoutes {
  static const WELCOME = '/welcome';
  static const LOGIN = '/login';
  static const DASHBOARD = '/dashboard';
  static const PROFILE = '/profile';
  static const PERTANDINGAN = '/pertandingan';
  static const RANKING = '/ranking';

  static final routes = [
    GetPage(
      name: WELCOME,
      page: () => WelcomePage(),
    ),
    GetPage(
      name: LOGIN,
      page: () => LoginPage(),
      transition: Transition.fadeIn,
      transitionDuration: Duration(milliseconds: 800),
    ),
    GetPage(
      name: DASHBOARD,
      page: () => DashboardPage(),
    ),
    GetPage(
      name: PROFILE,
      page: () => ProfilePage(),
    ),
    GetPage(
      name: PERTANDINGAN,
      page: () => PertandinganPage(),
    ),
    GetPage(
      name: RANKING,
      page: () => RankingPage(),
    ),
  ];
}
