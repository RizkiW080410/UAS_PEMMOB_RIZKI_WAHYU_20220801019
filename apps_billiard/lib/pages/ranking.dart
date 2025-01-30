import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:get/get.dart';
import '../services/api_service.dart';

class RankingPage extends StatefulWidget {
  @override
  _RankingPageState createState() => _RankingPageState();
}

class _RankingPageState extends State<RankingPage> {
  final ApiService _apiService = Get.find<ApiService>();
  bool _isLoading = true;
  List<dynamic> _rankings = [];

  @override
  void initState() {
    super.initState();
    _fetchRankings();
  }

  // **Mengambil data ranking dari API**
  Future<void> _fetchRankings() async {
    try {
      final response = await _apiService.fetchRankings();
      setState(() {
        _rankings = response;
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
        backgroundColor: Colors.white,
        elevation: 0,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.black),
          onPressed: () {
            Navigator.pop(context);
          },
        ),
        actions: [
          Padding(
            padding: const EdgeInsets.only(right: 16.0, top: 8.0),
            child: Transform.scale(
              scale: 1.7,
              child: SizedBox(
                child: Image.asset(
                  'assets/images/logo2.png',
                ),
              ),
            ),
          ),
        ],
      ),
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              const SizedBox(height: 16),
              Text(
                "Ranking Pemain",
                style: GoogleFonts.poppins(
                  fontSize: 24,
                  fontWeight: FontWeight.bold,
                  color: const Color.fromARGB(255, 74, 74, 74),
                ),
              ),
              const SizedBox(height: 24),

              // **Tabel Ranking**
              Expanded(
                child: _isLoading
                    ? Center(
                        child:
                            CircularProgressIndicator()) // **Loading Indicator**
                    : _rankings.isEmpty
                        ? Center(
                            child: Text(
                              "Tidak ada data ranking",
                              style: GoogleFonts.poppins(
                                fontSize: 16,
                                color: Colors.grey,
                              ),
                            ),
                          )
                        : SingleChildScrollView(
                            child: Container(
                              padding: const EdgeInsets.all(16),
                              decoration: BoxDecoration(
                                color: Colors.blue[50],
                                borderRadius: BorderRadius.circular(12),
                              ),
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Text(
                                    "10 Besar",
                                    style: GoogleFonts.poppins(
                                      fontSize: 16,
                                      fontWeight: FontWeight.bold,
                                      color:
                                          const Color.fromARGB(255, 74, 74, 74),
                                    ),
                                  ),
                                  const SizedBox(height: 16),

                                  // **Tabel Ranking**
                                  Table(
                                    columnWidths: const {
                                      0: FlexColumnWidth(3),
                                      1: FlexColumnWidth(1),
                                      2: FlexColumnWidth(1),
                                      3: FlexColumnWidth(1),
                                    },
                                    border: TableBorder.symmetric(
                                      inside:
                                          BorderSide(color: Colors.grey[300]!),
                                    ),
                                    children: [
                                      TableRow(
                                        children: [
                                          _buildTableCell("Nama Pemain",
                                              isHeader: true, alignLeft: true),
                                          _buildTableCell("Win",
                                              isHeader: true),
                                          _buildTableCell("Lose",
                                              isHeader: true),
                                          _buildTableCell("Rank",
                                              isHeader: true),
                                        ],
                                      ),
                                      ..._rankings.asMap().entries.map((entry) {
                                        int rank = entry.key + 1;
                                        var ranking = entry.value;
                                        return TableRow(
                                          children: [
                                            _buildTableCell(
                                                ranking['name'] ?? 'Unknown',
                                                alignLeft: true),
                                            _buildTableCell(
                                                ranking['win']?.toString() ??
                                                    '0'),
                                            _buildTableCell(
                                                ranking['lose']?.toString() ??
                                                    '0'),
                                            _buildTableCell(rank.toString()),
                                          ],
                                        );
                                      }).toList(),
                                    ],
                                  ),
                                ],
                              ),
                            ),
                          ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  // **Fungsi untuk membangun sel tabel**
  Widget _buildTableCell(String text,
      {bool isHeader = false, bool alignLeft = false}) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8.0, horizontal: 4.0),
      child: Text(
        text,
        textAlign: alignLeft ? TextAlign.left : TextAlign.center,
        style: GoogleFonts.poppins(
          fontSize: 14,
          fontWeight: isHeader ? FontWeight.bold : FontWeight.normal,
          color: const Color.fromARGB(255, 74, 74, 74),
        ),
      ),
    );
  }
}
