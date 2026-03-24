export const mockData = {
  header: {
    logoText: "EduChain",
    navLinks: [
      { id: "verify", label: "Verify", href: "#scanner" },
      { id: "login", label: "Login", href: "/login" },
      { id: "register", label: "Register", href: "/register" }
    ]
  },
  hero: {
    badgeText: "Web3 Verified",
    titleStart: "Verify Your Degree on the",
    titleHighlight: "Blockchain",
    titleEnd: "instantly.",
    subtitle: "Experience the future of academic validation with our decentralized, secure, and instant verification portal. Tamper-proof credentials at your fingertips.",
    ctaPrimary: {
      label: "Verify a Degree",
      href: "#scanner"
    },
    ctaSecondary: {
      label: "Join as Recruiter",
      href: "/register"
    },
    scannerText: "Scanning Credentials..."
  },
  features: {
    title: "Why Choose EduChain?",
    subtitle: "Our platform leverages cutting-edge blockchain technology to ensure your credentials are tamper-proof and universally recognized.",
    items: [
      {
        id: "instant",
        icon: "bolt",
        title: "Instant Verification",
        description: "Verify credentials in seconds, eliminating weeks of administrative back-and-forth between institutions."
      },
      {
        id: "immutable",
        icon: "shield",
        title: "Immutable Records",
        description: "Once stored, records cannot be altered or deleted. Your academic legacy is permanently secured."
      },
      {
        id: "portable",
        icon: "public",
        title: "Global Portability",
        description: "Share your verified profile with employers and universities worldwide without physical documentation."
      }
    ]
  },
  stats: [
    { id: "degrees", label: "Degrees Verified", value: "1.2M+" },
    { id: "institutions", label: "Institutions", value: "500+" },
    { id: "uptime", label: "Security Uptime", value: "99.9%" }
  ],
  ctaBottom: {
    title: "Ready to secure your academic future?",
    subtitle: "Join thousands of graduates and top-tier institutions already building trust with EduChain.",
    buttonLabel: "Get Started Now",
    buttonHref: "/register"
  },
  footer: {
    copyright: "© 2026 EduChain Protocol. All rights reserved.",
    links: [
        { id: "language", icon: "language", href: "#" },
        { id: "share", icon: "share", href: "#" },
        { id: "help", icon: "help", href: "#" }
    ]
  }
};
