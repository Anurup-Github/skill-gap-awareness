// api/submit.js
export default async function handler(req, res) {
  if (req.method !== 'POST') {
    return res.status(405).send('Method Not Allowed');
  }

  const { name, email, motivation, level, goal, language } = req.body;

  if (!name || !email || !motivation || !level || !goal || !language) {
    return res.status(400).send('Missing required fields');
  }

  // ⚠️ You can't use MySQL from InfinityFree inside Vercel.
  // You need to use a cloud DB like PlanetScale, Neon, Supabase, or Firebase instead.
  // For now, we'll simulate successful registration:

  console.log("Received:", { name, email, motivation, level, goal, language });

  // Redirect to mentor match
  res.redirect(302, `/match-mentors.html?goal=${goal}&level=${level}&language=${language}`);
}
