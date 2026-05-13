// ======================================
// PAWPAL MOBILE APP FULL CODE
// ======================================

import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

void main() {
  runApp(const PawPalApp());
}

class PawPalApp extends StatelessWidget {
  const PawPalApp({super.key});

  @override
  Widget build(BuildContext context) {

    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: const LoginPage(),
    );
  }
}

// ======================================
// LOGIN PAGE
// ======================================

class LoginPage extends StatefulWidget {
  const LoginPage({super.key});

  @override
  State<LoginPage> createState() =>
      _LoginPageState();
}

class _LoginPageState
    extends State<LoginPage> {

  final emailController =
      TextEditingController();

  final passwordController =
      TextEditingController();

  bool loading = false;

  Future login() async {

    setState(() {
      loading = true;
    });

    try {

      var response = await http.post(

        Uri.parse(
          'http://127.0.0.1:8000/api/login',
        ),

        body: {
          'email': emailController.text,
          'password':
              passwordController.text,
        },
      );

      var data = jsonDecode(response.body);

      setState(() {
        loading = false;
      });

      if (response.statusCode == 200) {

        Navigator.pushReplacement(

          context,

          MaterialPageRoute(

            builder: (context) =>
                DashboardPage(
              email:
                  emailController.text,
            ),
          ),
        );

      } else {

        ScaffoldMessenger.of(context)
            .showSnackBar(

          SnackBar(
            content: Text(
              data['message']
                  .toString(),
            ),
          ),
        );
      }

    } catch (e) {

      setState(() {
        loading = false;
      });

      ScaffoldMessenger.of(context)
          .showSnackBar(

        const SnackBar(
          content: Text(
            'Connection Error',
          ),
        ),
      );
    }
  }

  @override
  Widget build(BuildContext context) {

    return Scaffold(

      body: Container(

        decoration: const BoxDecoration(

          gradient: LinearGradient(

            begin: Alignment.topLeft,
            end: Alignment.bottomRight,

            colors: [
              Color(0xFF040816),
              Color(0xFF0D1230),
              Colors.black,
            ],
          ),
        ),

        child: Center(

          child: SingleChildScrollView(

            padding:
                const EdgeInsets.all(25),

            child: Container(

              padding:
                  const EdgeInsets.all(25),

              decoration: BoxDecoration(

                color:
                    Colors.white.withOpacity(
                  0.06,
                ),

                borderRadius:
                    BorderRadius.circular(
                  30,
                ),

                border: Border.all(
                  color: Colors.white10,
                ),
              ),

              child: Column(

                children: [

                  const Icon(
                    Icons.pets,
                    color:
                        Colors.deepPurpleAccent,
                    size: 90,
                  ),

                  const SizedBox(height: 20),

                  const Text(

                    'PawPal 🐾',

                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 40,
                      fontWeight:
                          FontWeight.bold,
                    ),
                  ),

                  const SizedBox(height: 10),

                  const Text(

                    'Premium Pet Care',

                    style: TextStyle(
                      color: Colors.white70,
                      fontSize: 18,
                    ),
                  ),

                  const SizedBox(height: 40),

                  TextField(

                    controller:
                        emailController,

                    style: const TextStyle(
                      color: Colors.white,
                    ),

                    decoration:
                        inputDecoration(
                      'Email',
                    ),
                  ),

                  const SizedBox(height: 20),

                  TextField(

                    controller:
                        passwordController,

                    obscureText: true,

                    style: const TextStyle(
                      color: Colors.white,
                    ),

                    decoration:
                        inputDecoration(
                      'Password',
                    ),
                  ),

                  const SizedBox(height: 30),

                  SizedBox(

                    width: double.infinity,
                    height: 60,

                    child: ElevatedButton(

                      onPressed:
                          loading
                              ? null
                              : login,

                      style:
                          ElevatedButton.styleFrom(

                        backgroundColor:
                            Colors
                                .deepPurpleAccent,

                        shape:
                            RoundedRectangleBorder(
                          borderRadius:
                              BorderRadius.circular(
                            20,
                          ),
                        ),
                      ),

                      child: loading

                          ? const CircularProgressIndicator(
                              color:
                                  Colors.white,
                            )

                          : const Text(

                              'LOGIN 🚀',

                              style:
                                  TextStyle(
                                color:
                                    Colors
                                        .white,
                                fontWeight:
                                    FontWeight
                                        .bold,
                                fontSize: 18,
                              ),
                            ),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }

  InputDecoration inputDecoration(
      String label) {

    return InputDecoration(

      labelText: label,

      labelStyle: const TextStyle(
        color: Colors.white70,
      ),

      filled: true,

      fillColor:
          Colors.white.withOpacity(0.08),

      border: OutlineInputBorder(

        borderRadius:
            BorderRadius.circular(20),

        borderSide: BorderSide.none,
      ),
    );
  }
}

// ======================================
// DASHBOARD PAGE
// ======================================

class DashboardPage extends StatefulWidget {

  final String email;

  const DashboardPage({
    super.key,
    required this.email,
  });

  @override
  State<DashboardPage> createState() =>
      _DashboardPageState();
}

class _DashboardPageState
    extends State<DashboardPage> {

  List services = [];

  Future fetchServices() async {

    try {

      var response = await http.get(

        Uri.parse(
          'http://127.0.0.1:8000/api/services',
        ),
      );

      var data = jsonDecode(response.body);

      setState(() {
        services = data;
      });

    } catch (e) {}
  }

  @override
  void initState() {
    super.initState();
    fetchServices();
  }

  @override
  Widget build(BuildContext context) {

    return Scaffold(

      body: Container(

        decoration: const BoxDecoration(

          gradient: LinearGradient(

            begin: Alignment.topLeft,
            end: Alignment.bottomRight,

            colors: [
              Color(0xFF040816),
              Color(0xFF0D1230),
              Colors.black,
            ],
          ),
        ),

        child: SafeArea(

          child: SingleChildScrollView(

            padding:
                const EdgeInsets.all(20),

            child: Column(

              crossAxisAlignment:
                  CrossAxisAlignment.start,

              children: [

                Row(

                  mainAxisAlignment:
                      MainAxisAlignment
                          .spaceBetween,

                  children: [

                    const Text(

                      'PawPal 🐾',

                      style: TextStyle(
                        color: Colors.white,
                        fontSize: 30,
                        fontWeight:
                            FontWeight.bold,
                      ),
                    ),

                    ElevatedButton(

                      onPressed: () {

                        Navigator.pushReplacement(

                          context,

                          MaterialPageRoute(
                            builder:
                                (context) =>
                                    const LoginPage(),
                          ),
                        );
                      },

                      style:
                          ElevatedButton
                              .styleFrom(
                        backgroundColor:
                            Colors.red,
                      ),

                      child: const Text(
                        'Logout',
                        style: TextStyle(
                          color:
                              Colors.white,
                        ),
                      ),
                    ),
                  ],
                ),

                const SizedBox(height: 30),

                Text(

                  'Welcome, ${widget.email} 👋',

                  style: const TextStyle(
                    color: Colors.white,
                    fontSize: 38,
                    fontWeight:
                        FontWeight.bold,
                  ),
                ),

                const SizedBox(height: 30),

                actionButton(
                  '🐾 Find Sitters',
                  Colors.orange,

                  () {

                    Navigator.push(

                      context,

                      MaterialPageRoute(

                        builder:
                            (context) =>
                                const SittersPage(),
                      ),
                    );
                  },
                ),

                const SizedBox(height: 15),

                actionButton(
                  '📖 My Bookings',
                  Colors.green,

                  () {

                    Navigator.push(

                      context,

                      MaterialPageRoute(

                        builder:
                            (context) =>
                                const BookingsPage(),
                      ),
                    );
                  },
                ),

                const SizedBox(height: 15),

                actionButton(
                  '💬 Messages',
                  Colors.purple,

                  () {

                    Navigator.push(

                      context,

                      MaterialPageRoute(

                        builder:
                            (context) =>
                                const MessagesPage(),
                      ),
                    );
                  },
                ),

                const SizedBox(height: 15),

                actionButton(
                  '👤 Profile',
                  Colors.blue,

                  () {

                    Navigator.push(

                      context,

                      MaterialPageRoute(

                        builder:
                            (context) =>
                                ProfilePage(
                          email:
                              widget.email,
                        ),
                      ),
                    );
                  },
                ),

                const SizedBox(height: 40),

                const Text(

                  'Available Providers 🐾',

                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 30,
                    fontWeight:
                        FontWeight.bold,
                  ),
                ),

                const SizedBox(height: 20),

                services.isEmpty

                    ? const Center(
                        child:
                            CircularProgressIndicator(
                          color:
                              Colors.white,
                        ),
                      )

                    : Column(

                        children:
                            services.map((service) {

                          return providerCard(
                            service,
                          );

                        }).toList(),
                      ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget actionButton(
    String text,
    Color color,
    VoidCallback onPressed,
  ) {

    return SizedBox(

      width: double.infinity,
      height: 60,

      child: ElevatedButton(

        onPressed: onPressed,

        style:
            ElevatedButton.styleFrom(

          backgroundColor: color,

          shape: RoundedRectangleBorder(
            borderRadius:
                BorderRadius.circular(
              20,
            ),
          ),
        ),

        child: Text(

          text,

          style: const TextStyle(
            color: Colors.white,
            fontSize: 18,
            fontWeight:
                FontWeight.bold,
          ),
        ),
      ),
    );
  }

  Widget providerCard(service) {

    return Container(

      margin:
          const EdgeInsets.only(bottom: 20),

      padding: const EdgeInsets.all(20),

      decoration: BoxDecoration(

        color:
            Colors.white.withOpacity(0.05),

        borderRadius:
            BorderRadius.circular(25),

        border: Border.all(
          color: Colors.white10,
        ),
      ),

      child: Column(

        crossAxisAlignment:
            CrossAxisAlignment.start,

        children: [

          Text(

            service['name']
                    ?.toString() ??
                'Service',

            style: const TextStyle(
              color: Colors.white,
              fontSize: 24,
              fontWeight:
                  FontWeight.bold,
            ),
          ),

          const SizedBox(height: 10),

          Text(

            service['description']
                    ?.toString() ??
                '',

            style: const TextStyle(
              color: Colors.white70,
            ),
          ),

          const SizedBox(height: 15),

          Text(

            '₱${service['price']}',

            style: const TextStyle(
              color: Colors.greenAccent,
              fontSize: 28,
              fontWeight:
                  FontWeight.bold,
            ),
          ),

          const SizedBox(height: 20),

          SizedBox(

            width: double.infinity,
            height: 55,

            child: ElevatedButton(

              onPressed: () {

                ScaffoldMessenger.of(context)
                    .showSnackBar(

                  SnackBar(
                    content: Text(
                      '${service['name']} booked!',
                    ),
                  ),
                );
              },

              style:
                  ElevatedButton.styleFrom(

                backgroundColor:
                    Colors.deepPurpleAccent,

                shape:
                    RoundedRectangleBorder(
                  borderRadius:
                      BorderRadius.circular(
                    18,
                  ),
                ),
              ),

              child: const Text(

                'Book Service 🚀',

                style: TextStyle(
                  color: Colors.white,
                  fontWeight:
                      FontWeight.bold,
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}

// ======================================
// SITTERS PAGE
// ======================================

class SittersPage extends StatelessWidget {
  const SittersPage({super.key});

  @override
  Widget build(BuildContext context) {

    return simplePage(
      context,
      'Find Sitters 🐾',
    );
  }
}

// ======================================
// BOOKINGS PAGE
// ======================================

class BookingsPage extends StatelessWidget {
  const BookingsPage({super.key});

  @override
  Widget build(BuildContext context) {

    return simplePage(
      context,
      'My Bookings 📖',
    );
  }
}

// ======================================
// MESSAGES PAGE
// ======================================

class MessagesPage extends StatelessWidget {
  const MessagesPage({super.key});

  @override
  Widget build(BuildContext context) {

    return simplePage(
      context,
      'Messages 💬',
    );
  }
}

// ======================================
// PROFILE PAGE
// ======================================

class ProfilePage extends StatelessWidget {

  final String email;

  const ProfilePage({
    super.key,
    required this.email,
  });

  @override
  Widget build(BuildContext context) {

    return Scaffold(

      body: Container(

        decoration: const BoxDecoration(

          gradient: LinearGradient(

            begin: Alignment.topLeft,
            end: Alignment.bottomRight,

            colors: [
              Color(0xFF040816),
              Color(0xFF0D1230),
              Colors.black,
            ],
          ),
        ),

        child: SafeArea(

          child: Padding(

            padding:
                const EdgeInsets.all(20),

            child: Column(

              crossAxisAlignment:
                  CrossAxisAlignment.start,

              children: [

                IconButton(

                  onPressed: () {
                    Navigator.pop(context);
                  },

                  icon: const Icon(
                    Icons.arrow_back,
                    color: Colors.white,
                  ),
                ),

                const SizedBox(height: 30),

                const CircleAvatar(

                  radius: 50,

                  backgroundColor:
                      Colors.deepPurpleAccent,

                  child: Icon(
                    Icons.person,
                    color: Colors.white,
                    size: 50,
                  ),
                ),

                const SizedBox(height: 30),

                Text(

                  email,

                  style: const TextStyle(
                    color: Colors.white,
                    fontSize: 28,
                    fontWeight:
                        FontWeight.bold,
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}

// ======================================
// SIMPLE PAGE TEMPLATE
// ======================================

Widget simplePage(
  BuildContext context,
  String title,
) {

  return Scaffold(

    body: Container(

      decoration: const BoxDecoration(

        gradient: LinearGradient(

          begin: Alignment.topLeft,
          end: Alignment.bottomRight,

          colors: [
            Color(0xFF040816),
            Color(0xFF0D1230),
            Colors.black,
          ],
        ),
      ),

      child: SafeArea(

        child: Padding(

          padding:
              const EdgeInsets.all(20),

          child: Column(

            crossAxisAlignment:
                CrossAxisAlignment.start,

            children: [

              IconButton(

                onPressed: () {
                  Navigator.pop(context);
                },

                icon: const Icon(
                  Icons.arrow_back,
                  color: Colors.white,
                ),
              ),

              const SizedBox(height: 20),

              Text(

                title,

                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 35,
                  fontWeight:
                      FontWeight.bold,
                ),
              ),
            ],
          ),
        ),
      ),
    ),
  );
}