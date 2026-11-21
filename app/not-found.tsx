import Link from "next/link";

export default function NotFound() {
  return (
    <main className="min-h-[60vh] flex items-center">
      <div className="max-w-xl mx-auto px-6 py-24 text-center">
        <p className="text-xs uppercase font-mono tracking-widest text-blue-400 mb-3">404</p>
        <h1 className="text-3xl sm:text-4xl font-bold text-white mb-4">This page is not here.</h1>
        <p className="text-neutral-400 text-sm mb-8">
          The link may be old. The homepage and the contact page are both working.
        </p>
        <div className="flex flex-wrap items-center justify-center gap-3">
          <Link
            href="/"
            className="px-6 py-3 rounded-full bg-white text-black font-semibold text-sm"
          >
            Back home
          </Link>
          <Link
            href="/contact/"
            className="px-6 py-3 rounded-full border border-white/10 text-white text-sm"
          >
            Contact
          </Link>
        </div>
      </div>
    </main>
  );
}
