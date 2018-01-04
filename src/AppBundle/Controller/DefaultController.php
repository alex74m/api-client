<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction()
    {
        return $this->render('default/admin.html.twig');
    }

    /**
     * @Route("/admin/auth", name="admin_auth")
     */
    public function adminAuthAction()
    {
        // To avoid the ?code= url. Can be done with Javascript.
        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/admin/articles", name="get_articles")
     */
    public function getArticlesAction()
    {
        $response = $this->get('csa_guzzle.client.my_api')->get($this->getParameter('my_api_url').'/articles');
        $articles = $this->get('serializer')->deserialize($response->getBody()->getContents(), 'array', 'json');

        return $this->render('default/articles.html.twig', ['articles' => $articles]);
    }


    /**
     * @Route("/admin/logout", name="logout")
     */
    public function logoutAction()
    {
    }
}
