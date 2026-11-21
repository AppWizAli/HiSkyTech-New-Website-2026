import type { Metadata } from "next";
import { Plus_Jakarta_Sans, Space_Grotesk } from "next/font/google";
import { ChatWidget } from "@/components/ChatWidget";
import { Footer } from "@/components/Footer";
import { Header } from "@/components/Header";
import { JsonLd } from "@/components/JsonLd";
import { SITE_NAME, SITE_URL } from "@/lib/site";
import "./globals.css";

const sans = Plus_Jakarta_Sans({
  subsets: ["latin"],
  variable: "--font-plus-jakarta-sans",
  display: "swap",
});

const mono = Space_Grotesk({
  subsets: ["latin"],
  variable: "--font-space-grotesk",
  display: "swap",
});

const title = "HiSkyTech — AI Development & Digital Experiences";
const description =
  "We help businesses automate repetitive workflows, build intelligent AI calling systems, and create modern apps and websites that turn ideas into real digital products.";

export const metadata: Metadata = {
  metadataBase: new URL(SITE_URL),
  title: {
    default: title,
    template: `%s — ${SITE_NAME}`,
  },
  description,
  alternates: {
    canonical: `${SITE_URL}/`,
  },
  openGraph: {
    title,
    description: "AI Automation, AI Calling Agents, Mobile Apps, and Website Development.",
    url: `${SITE_URL}/`,
    siteName: SITE_NAME,
    type: "website",
    locale: "en_US",
    images: [
      {
        url: "/og.png",
        width: 1200,
        height: 630,
        alt: "HiSkyTech — AI receptionists, voice agents, and automation",
      },
    ],
  },
  twitter: {
    card: "summary_large_image",
    title,
    description: "AI Automation, AI Calling Agents, Mobile Apps, and Website Development.",
    images: ["/og.png"],
  },
  icons: {
    icon: "/icon.png",
    apple: "/apple-icon.png",
  },
  robots: {
    index: true,
    follow: true,
  },
};

export default function RootLayout({ children }: Readonly<{ children: React.ReactNode }>) {
  return (
    <html lang="en" className={`${sans.variable} ${mono.variable} scroll-smooth`}>
      <body className="bg-brand-dark text-slate-100 font-sans antialiased selection:bg-blue-600 selection:text-white">
        <JsonLd />
        <Header />
        {children}
        <Footer />
        <ChatWidget />
      </body>
    </html>
  );
}
