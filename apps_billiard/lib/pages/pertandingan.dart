import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:get/get.dart';
import '../services/api_service.dart';

class PertandinganPage extends StatefulWidget {
  @override
  _PertandinganPageState createState() => _PertandinganPageState();
}

class _PertandinganPageState extends State<PertandinganPage> {
  final ApiService _apiService = Get.find<ApiService>();
  bool _isLoading = true;
  List<dynamic> _matches = [];

  @override
  void initState() {
    super.initState();
    _fetchMatches();
  }

  // **Fungsi untuk mengambil data pertandingan dari API**
  Future<void> _fetchMatches() async {
    try {
      final response = await _apiService.fetchPertandingans();
      setState(() {
        _matches = response; // Menyimpan data pertandingan
        _isLoading = false;
      });
    } catch (e) {
      Get.snackbar(
        'Error',
        e.toString(),
        backgroundColor: Colors.redAccent,
        colorText: Colors.white,
        snackPosition: SnackPosition.BOTTOM,
      );
      setState(() {
        _isLoading = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.white,
        leading: IconButton(
          icon: Icon(Icons.arrow_back, color: Colors.black),
          onPressed: () => Navigator.pop(context),
        ),
        title: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            const SizedBox(),
            Padding(
              padding: const EdgeInsets.only(top: 9.0),
              child: Image.asset(
                'assets/images/logo2.png',
                width: 75,
                height: 75,
              ),
            ),
          ],
        ),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              'Pertandingan',
              style: GoogleFonts.poppins(
                fontSize: 24,
                fontWeight: FontWeight.bold,
                color: const Color.fromARGB(255, 74, 74, 74),
              ),
            ),
            const SizedBox(height: 16),
            Expanded(
              child: _isLoading
                  ? Center(
                      child:
                          CircularProgressIndicator()) // **Loading Indicator**
                  : _matches.isEmpty
                      ? Center(
                          child: Text(
                            "Tidak ada pertandingan",
                            style: GoogleFonts.poppins(
                              fontSize: 16,
                              color: Colors.grey,
                            ),
                          ),
                        )
                      : ListView.builder(
                          itemCount: _matches.length,
                          itemBuilder: (context, index) {
                            var match = _matches[index];
                            return _buildMatchCard(
                              title: match['category'] ?? 'Unknown',
                              date: match['start_time'] ?? 'Unknown',
                              matchId:
                                  match['pertandingan_number'] ?? 'Unknown',
                              playerAScore: match['skor_a'].toString(),
                              playerBScore: match['skor_b'].toString(),
                              status: match['status'] ?? 'Unknown',
                              statusColor: _getStatusColor(match['status']),
                            );
                          },
                        ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildMatchCard({
    required String title,
    required String date,
    required String matchId,
    required String playerAScore,
    required String playerBScore,
    required String status,
    required Color statusColor,
  }) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.blue[50],
        borderRadius: BorderRadius.circular(16),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Text(
                title,
                style: GoogleFonts.poppins(
                  fontSize: 16,
                  fontWeight: FontWeight.bold,
                  color: const Color.fromARGB(255, 74, 74, 74),
                ),
              ),
              Text(
                matchId,
                style: GoogleFonts.poppins(
                  fontSize: 12,
                  color: Colors.grey,
                ),
              ),
            ],
          ),
          const SizedBox(height: 4),
          Text(
            date,
            style: GoogleFonts.poppins(fontSize: 12, color: Colors.grey),
          ),
          const SizedBox(height: 8),
          Row(
            children: [
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text('Pemain A',
                        style: GoogleFonts.poppins(
                            fontSize: 14, fontWeight: FontWeight.w500)),
                    Text(playerAScore,
                        style: GoogleFonts.poppins(fontSize: 14)),
                  ],
                ),
              ),
              const Text('VS',
                  style: TextStyle(fontSize: 14, fontWeight: FontWeight.bold)),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.end,
                  children: [
                    Text('Pemain B',
                        style: GoogleFonts.poppins(
                            fontSize: 14, fontWeight: FontWeight.w500)),
                    Text(playerBScore,
                        style: GoogleFonts.poppins(fontSize: 14)),
                  ],
                ),
              ),
            ],
          ),
          const SizedBox(height: 12),
          Align(
            alignment: Alignment.bottomRight,
            child: Container(
              padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
              decoration: BoxDecoration(
                color: statusColor,
                borderRadius: BorderRadius.circular(12),
              ),
              child: Text(status,
                  style:
                      GoogleFonts.poppins(fontSize: 12, color: Colors.white)),
            ),
          ),
        ],
      ),
    );
  }

  Color _getStatusColor(String status) {
    switch (status.toLowerCase()) {
      case 'selesai':
        return Colors.green;
      case 'berlangsung':
        return Colors.orange;
      default:
        return Colors.blue;
    }
  }
}
